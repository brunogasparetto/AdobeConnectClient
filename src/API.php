<?php

namespace AdobeConnectClient;

/**
 * Adobe Connect API abstraction
 *
 * @todo Improve the Exceptions including better messages
 */
class API
{

    /**
     * Set the passcode on a Recording and turned into public.
     *
     * Obs: to set the passcode on a Meeting use the aclFieldUpdate method with the
     * meeting-passcode as the fieldId and the passcode as the value.
     *
     * @param int $scoId The Recording SCO ID
     * @param string $passcode The passcode
     * @return boolean
     */
    public function recordingPasscode($scoId, $passcode)
    {
        try {
            $permission = new Permission();
            $permission->principalId = Permission::MEETING_PRINCIPAL_PUBLIC_ACCESS;
            $permission->permissionId = Permission::RECORDING_PUBLIC;
            $permission->aclId = $scoId;

            if (!$this->permissionUpdate($permission)) {
                return false;
            }

            return $this->aclFieldUpdate($scoId, 'meetingPasscode', $passcode, [
                'isMtgPasscodeReq' => 'true',
                'permissionId' => Permission::RECORDING_PUBLIC,
                'principalId' => Permission::MEETING_PRINCIPAL_PUBLIC_ACCESS,
            ]);

            $this->getResponse('acl-field-update', [
                'acl-id' => $scoId,
                'field-id' => 'meeting-passcode',
                'value' => $passcode,
                'is-mtg-passcode-req' => 'true',
                'permission-id' => 'view',
                'principal-id' => 'public-access',
            ]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Uploads a file to the server and then builds the file, if necessary.
     *
     * Create a new File SCO or update if exists in the folder (a SCO Meeting) and upload the file.
     *
     * See {@link https://helpx.adobe.com/adobe-connect/webservices/sco-upload.html}
     *
     * Important: the filename (filePath) needs the extension for API purpose.
     *
     * @param int $folderId The SCO folder
     * @param string $name The SCO File name
     * @param string $filePath The absolute path. Needs the file extension for the Adobe Connect API validation.
     * @return boolean
     */
    public function scoUpload($folderId, $name, $filePath)
    {
        try {
            $filter = new \AdobeConnectClient\Filter();
            $filter
                ->equals('folderId', $folderId)
                ->equals('name', $name)
                ->equals('type', \AdobeConnectClient\SCO::TYPE_CONTENT);
            $scos = $this->scoContents($folderId, $filter);

            if (!empty($scos)) {
                $scoFile = reset($scos);
            } else {
                $sco = new \AdobeConnectClient\SCO();
                $sco->type = \AdobeConnectClient\SCO::TYPE_CONTENT;
                $sco->folderId = $folderId;
                $sco->name = $name;
                $scoFile = $this->scoCreate($sco);
            }

            if (!$scoFile->scoId) {
                throw new \Exception('Error to create SCO File');
            }
            return $this->sendFile($scoFile->scoId, $filePath);
        } catch (\Exception $ex) {
            return false;
        }
    }

    /**
     * Get a list of principals who have permissions to act on a SCO, Principal or Account
     *
     * See {@link https://helpx.adobe.com/adobe-connect/webservices/permissions-info.html}
     *
     * @param int $aclId SCO ID, Principal ID or Account ID
     * @param \AdobeConnectClient\Parameter $filter The filters to reduce the response
     * @param \AdobeConnectClient\Parameter $sort The sorter
     * @return array Array of \AdobeConnectClient\Principal
     */
    public function permissionsInfo($aclId, Parameter $filter = null, Parameter $sort = null)
    {
        try {
            $response = $this->getResponse(
                'permissions-info',
                $this->mergeParamsInArray(['acl-id' => $aclId], $filter, $sort)
            );
            $result = [];

            foreach ($response->permissions->principal as $principalElement) {
                $result[] = new Principal($principalElement);
            }
            return $result;
        } catch (\Exception $ex) {
            return [];
        }
    }

    /**
     * Get the Principal's permission in a SCO, Principal or Account
     *
     * See {@link https://helpx.adobe.com/adobe-connect/webservices/permissions-info.html}
     *
     * @param int $aclId SCO ID, Principal ID or Account ID
     * @param int $principalId The Principal ID
     * @return \AdobeConnectClient\Permission
     */
    public function permissionInfoFromPrincipal($aclId, $principalId)
    {
        try {
            $response = $this->getResponse('permissions-info', ['acl-id' => $aclId, 'principal-id' => $principalId]);
            return new Permission($response->permission);
        } catch (\Exception $ex) {
            return new Permission();
        }
    }

    /**
     * Updates the permissions a principal has to access a SCO or the access mode if the acl-id is a Meeting.
     *
     * Update Access see {@link https://helpx.adobe.com/adobe-connect/webservices/permissions-update.html}
     *
     * More informationg about SCO access mode see
     * {@link https://helpx.adobe.com/adobe-connect/webservices/common-xml-elements-attributes.html#permission_id}
     *
     * @param \AdobeConnectClient\Parameter $parameter Can be a \AdobeConnectClient\Permission
     * @return boolean True if permission was updated
     */
    public function permissionUpdate(Parameter $parameter)
    {
        try {
            $this->getResponse('permissions-update', $parameter->toArray());
            return true;
        } catch (\Exception $ex) {
            return false;
        }
    }

    /**
     * Updates the passed in field-id for the specified acl-id.
     *
     * See {@link https://helpx.adobe.com/adobe-connect/webservices/acl-field-update.html}
     *
     * @param int $aclId SCO ID, Principal ID or Account ID
     * @param string $fieldId The field to update.
     * @param mixed $value The value to update
     * @param array $extraParams Extra params to send in the request. The keys are the fields.
     * @return boolean
     */
    public function aclFieldUpdate($aclId, $fieldId, $value, array $extraParams = [])
    {
        $params = [
            'acl-id' => $aclId,
            'field-id' => Helper\StringCaseTransform::toHyphen($fieldId),
            'value' => is_bool($value) ? Helper\BooleanTransform::toString($value) : $value,
        ];

        foreach ($extraParams as $extraFieldId => $extraParamValue) {
            $extraFieldId = Helper\StringCaseTransform::toHyphen($extraFieldId);
            $params[$extraFieldId] = is_bool($extraParamValue)
                ? Helper\BooleanTransform::toString($extraParamValue)
                : $extraParamValue;
        }

        try {
            $this->getResponse('acl-field-update', $params);
            return true;
        } catch (\Exception $ex) {
            return false;
        }
    }

    /**
     * Set a feature.
     *
     * See {@link https://helpx.adobe.com/adobe-connect/webservices/meeting-feature-update.html}
     *
     * @param int $accountId The ID of your Adobe Connect hosted account.
     * @param string $featureId The feature Id. Can be only the feature name em camelCase without the fid- prefix.
     * See @link https://helpx.adobe.com/adobe-connect/webservices/common-xml-elements-attributes.html#feature_id
     * @param boolean $enable Whether to enable the specified feature or not.
     * @return boolean
     */
    public function meetingFeatureUpdate($accountId, $featureId, $enable)
    {
        $featureId = Helper\StringCaseTransform::toHyphen($featureId);

        if (mb_strpos($featureId, 'fid-') === false) {
            $featureId = 'fid-' . $featureId;
        }

        try {
            $this->getResponse(
                'meeting-feature-update',
                [
                    'account-id' => $accountId,
                    'feature-id' => $featureId,
                    'enable' => Helper\BooleanTransform::toString($enable),
                ]
            );
            return true;
        } catch (\Exception $exc) {
            return false;
        }
    }

    /**
     * Merge a variable-length argument list into array
     *
     * @param mixed $params An array or \AdobeConnectClient\Parameter
     * @return array
     */
    protected function mergeParamsInArray(...$params)
    {
        $items = [];

        foreach ($params as $param) {
            if (is_array($param)) {
                $items = array_merge($items, $param);
            } elseif ($param instanceof Parameter) {
                $items = array_merge($items, $param->toArray());
            }
        }
        return $items;
    }


    /**
     * Set the Cookie from the Header Response
     *
     * @param string $responseCookie The Header response Set-Cookie
     */
    protected function setCookieFromHeader($responseCookie)
    {
        $matches = [];

        if (preg_match('/.*BREEZESESSION=([^;]+).*/', $responseCookie, $matches)) {
            $this->cookie = $matches[1];
        } else {
            $this->cookie = null;
        }
    }

    /**
     * Get the Response of the Request.
     *
     * @param string $action The Web Service Action.
     * @param array $params An array where key is the param name and value is the param value.
     * @return \SimpleXMLElement
     * @throws \DomainException
     */
    protected function getResponse($action, array $params = [])
    {
        $this->requestHandler->setParams(['action' => $action] + $params);

        if ($action === 'login') {
            return $this->requestHandler->getResponse(true);
        }
        if (!$this->isLogged()) {
            throw new \DomainException('Need login before make a request.');
        }
        $this->requestHandler->addParam('session', $this->cookie);
        return $this->requestHandler->getResponse();
    }

    /**
     * Post to Server and get the Response of the Request.
     *
     * @param string $action The Web Service Action.
     * @param array $getParams An array where key is the param name and value is the param value.
     * @param array $postParams An array where key is the param name and value is the param value.
     * @return \SimpleXMLElement
     * @throws \DomainException
     */
    protected function postResponse($action, array $getParams = [], array $postParams = [])
    {
        if (!$this->isLogged()) {
            throw new \DomainException('Need login before make a request.');
        }
        $this->requestHandler->setParams(['action' => $action, 'session' => $this->cookie] + $getParams);
        return $this->requestHandler->postResponse($postParams);
    }

    /**
     *
     * @param int $scoId The SCO ID to upload
     * @param string $filePath The filepath. Needs the file extension.
     * @return boolean
     * @throws \DomainException
     */
    protected function sendFile($scoId, $filePath)
    {
        if (!$this->isLogged()) {
            throw new \DomainException('Need login before make a request.');
        }
        $this->requestHandler->setParams([
            'action' => 'sco-upload',
            'session' => $this->cookie,
            'sco-id' => $scoId,
        ]);
        return $this->requestHandler->sendFile($filePath);
    }
}
