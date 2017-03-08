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
     * @var string The session cookie
     */
    private $cookie = '';

    /**
     * @var \AdobeConnectClient\RequestHandler $requestHandler The Request Handler
     */
    private $requestHandler = null;

    /**
     * @param mixed The Host URL or a \AdobeConnectClient\RequestHandler object
     */
    public function __construct($hostUrlOrRequestHandler)
    {
        if (is_string($hostUrlOrRequestHandler)) {
            $this->requestHandler = new RequestHandler($hostUrlOrRequestHandler);
        } elseif ($hostUrlOrRequestHandler instanceof RequestHandler) {
            $this->requestHandler = $hostUrlOrRequestHandler;
        } else {
            throw new \Exception('Invalid Parameter');
        }
    }

    /**
     * Get the Session Cookie
     *
     * @return string
     */
    public function getSessionCookie()
    {
        return $this->cookie;
    }

    /**
     * Set the Session Cookie to send in the Request.
     *
     * @param string $cookie
     */
    public function setSessionCookie($cookie)
    {
        $this->cookie = (string) $cookie;
    }

    /**
     * Indicates if API is logged
     *
     * @return boolean True if is logged
     */
    public function isLogged()
    {
        return !empty($this->cookie);
    }

    /**
     * Call the Login action and save the cookie if is a valid login/password.
     *
     * See {@link https://helpx.adobe.com/content/help/en/adobe-connect/webservices/login.html}
     *
     * @param string $login Login (E-Mail)
     * @param string $password Password
     * @return boolean True if logged in WS
     */
    public function login($login, $password)
    {
        $params = [
            'login' => $login,
            'password' => $password
        ];

        try {
            $response = $this->getResponse('login', $params, true);
            $this->setCookieFromHeader($response->header->SetCookie);
        } catch (\Exception $ex) {
            return false;
        }
        return $this->isLogged();
    }

    /**
     * Ends a user’s login session.
     *
     * See {@link https://helpx.adobe.com/content/help/en/adobe-connect/webservices/logout.html}
     *
     * @return boolean
     */
    public function logout()
    {
        try {
            $this->getResponse('logout');
            $this->cookie = '';
            return true;
        } catch (\Exception $ex) {
            return false;
        }
    }

    /**
     * Get the Common Info
     *
     * See {@link https://helpx.adobe.com/adobe-connect/webservices/common-info.html#common_info}
     *
     * @param string $domain A domain name identifying a Adobe Connect hosted account (optional)
     * @return \AdobeConnectClient\CommonInfo
     */
    public function commonInfo($domain = '')
    {
        try {
            $params = empty($domain) ? [] : ['domain' => $domain];
            return new CommonInfo($this->getResponse('common-info', $params)->common);
        } catch (\Exception $ex) {
            return new CommonInfo();
        }
    }

    /**
     * Get the SCO Contents from a folder or from other SCO
     *
     * See {@link https://helpx.adobe.com/content/help/en/adobe-connect/webservices/sco-contents.html}
     *
     * @param int $scoId Folder ID or SCO ID
     * @param \AdobeConnectClient\Parameter $filter The filters to reduce the response
     * @param \AdobeConnectClient\Parameter $sort The sorter
     * @return array Array of \AdobeConnectClient\SCO
     */
    public function scoContents($scoId, Parameter $filter = null, Parameter $sort = null)
    {
        try {
            $response = $this->getResponse(
                'sco-contents',
                $this->mergeParamsInArray(['sco-id' => $scoId], $filter, $sort)
            );
            $result = [];

            foreach ($response->scos->sco as $scoElement) {
                $result[] = new SCO($scoElement);
            }

            return $result;
        } catch (\Exception $ex) {
            return [];
        }
    }

    /**
     * Get the SCO Info
     *
     * See {@link https://helpx.adobe.com/adobe-connect/webservices/sco-info.html}
     *
     * @param int $scoId Folder ID or SCO ID
     * @return \AdobeConnectClient\SCO
     */
    public function scoInfo($scoId)
    {
        try {
            $response = $this->getResponse('sco-info', ['sco-id' => $scoId]);
            return new SCO($response->sco);
        } catch (\Exception $ex) {
            return new SCO();
        }
    }

    /**
     * Provides a list of recordings (FLV and MP4) for a specified folder.
     *
     * See {@link https://helpx.adobe.com/adobe-connect/webservices/list-recordings.html}
     *
     * @param int $folderId The SCO folder ID
     * @return array An array with SCORecord
     */
    public function listRecordings($folderId)
    {
        try {
            $response = $this->getResponse('list-recordings', ['folder-id' => $folderId]);
            $result = [];

            foreach ($response->recordings->sco as $scoElement) {
                $result[] = new SCORecord($scoElement);
            }
            return $result;
        } catch (\Exception $ex) {
            return [];
        }
    }

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
     * Create a SCO.
     *
     * See {@link https://helpx.adobe.com/adobe-connect/webservices/sco-update.html}
     *
     * @param \AdobeConnectClient\Parameter $parameter The SCO parameters. Can be a \AdobeConnectClient\SCO
     * @return \AdobeConnectClient\SCO
     */
    public function scoCreate(Parameter $parameter)
    {
        $params = $parameter->toArray();

        // Create a SCO only in a folder
        if (isset($params['sco-id'])) {
            unset($params['sco-id']);
        }

        try {
            $response = $this->getResponse('sco-update', $params);
            return new SCO($response->sco);
        } catch (\Exception $ex) {
            return new SCO();
        }
    }

    /**
     * Update a SCO.
     *
     * See {@link https://helpx.adobe.com/adobe-connect/webservices/sco-update.html}
     *
     * @param \AdobeConnectClient\Parameter $parameter The SCO parameters. Can be a \AdobeConnectClient\SCO
     * @return boolean
     */
    public function scoUpdate(Parameter $parameter)
    {
        $params = $parameter->toArray();

        // Update a SCO only with SCO ID
        if (isset($params['folder-id'])) {
            unset($params['folder-id']);
        }

        try {
            $this->getResponse('sco-update', $params);
            return true;
        } catch (\Exception $ex) {
            return false;
        }
    }

    /**
     * Deletes one or more objects (SCOs).
     *
     * See {@link https://helpx.adobe.com/adobe-connect/webservices/sco-delete.html}
     *
     * @param int $scoId SCO ID or Folder ID
     * @return boolean
     */
    public function scoDelete($scoId)
    {
        try {
            $this->getResponse('sco-delete', ['sco-id' => $scoId]);
            return true;
        } catch (\Exception $ex) {
            return false;
        }
    }

    /**
     * Moves a SCO from one folder to another.
     *
     * See {@link https://helpx.adobe.com/adobe-connect/webservices/sco-move.html}
     *
     * @param int $folderId Folder ID destination
     * @param int $scoId SCO ID to move
     * @return boolean
     */
    public function scoMove($folderId, $scoId)
    {
        try {
            $this->getResponse('sco-move', ['folder-id' => $folderId, 'sco-id' => $scoId]);
            return true;
        } catch (\Exception $ex) {
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
     * Provides information about one principal, either a user or a group.
     *
     * See {@link https://helpx.adobe.com/adobe-connect/webservices/principal-info.html}
     *
     * @param int $principalId The ID of a user or group you want information about.
     * @return \AdobeConnectClient\Principal
     */
    public function principalInfo($principalId)
    {
        try {
            $response = $this->getResponse('principal-info', ['principal-id' => $principalId]);
            return new Principal($response->principal);
        } catch (\Exception $ex) {
            return new Principal();
        }
    }

    /**
     * Provides a complete list of users and groups, including primary groups.
     *
     * See {@link https://helpx.adobe.com/adobe-connect/webservices/principal-list.html}
     *
     * @param int $groupId The ID of a group. Same as the principal-id of a principal that has a type value of group.
     * @param \AdobeConnectClient\Parameter $filter The filters to reduce the response
     * @param \AdobeConnectClient\Parameter $sort The sorter
     * @return array Arry of \AdobeConnectClient\Principal
     */
    public function principalList($groupId = 0, Parameter $filter = null, Parameter $sort = null)
    {
        $params = $this->mergeParamsInArray($filter, $sort);

        if ($groupId) {
            $params['group-id'] = $groupId;
        }

        try {
            $response = $this->getResponse('principal-list', $params);
            $result = [];

            foreach ($response->{'principal-list'}->principal as $principalElement) {
                $result[] = new Principal($principalElement);
            }
            return $result;
        } catch (\Exception $ex) {
            return [];
        }
    }

    /**
     * Create a Principal.
     *
     * See {@link https://helpx.adobe.com/adobe-connect/webservices/principal-update.html}
     *
     * @param \AdobeConnectClient\Parameter $principal The Principal
     * @return \AdobeConnectClient\Principal
     */
    public function principalCreate(Parameter $principal)
    {
        $params = $principal->toArray();
        unset($params['principal-id']);

        try {
            $response = $this->getResponse('principal-update', $params);
            return new Principal($response->principal);
        } catch (\Exception $ex) {
            return new Principal();
        }
    }

    /**
     * Update a Principal.
     *
     * See {@link https://helpx.adobe.com/adobe-connect/webservices/principal-update.html}
     *
     * @param \AdobeConnectClient\Parameter $principal The Principal
     * @return boolean
     */
    public function principalUpdate(Parameter $principal)
    {
        $params = $principal->toArray();
        unset($params['password'], $params['type'], $params['has-children']);

        try {
            $this->getResponse('principal-update', $params);
            return true;
        } catch (\Exception $exc) {
            return false;
        }
    }

    /**
     * Removes one or more principals, either users or groups.
     *
     * See {@link https://helpx.adobe.com/adobe-connect/webservices/principals-delete.html}
     *
     * @param int $principalId The ID of a user or group you want to delete.
     * @return boolean
     */
    public function principalDelete($principalId)
    {
        try {
            $this->getResponse('principals-delete', ['principal-id' => $principalId]);
            return true;
        } catch (\Exception $ex) {
            return false;
        }
    }

    /**
     * Changes a user’s password.
     *
     * See {@link https://helpx.adobe.com/adobe-connect/webservices/user-update-pwd.html}
     *
     * @param int $userId User ID. The same as Principal ID.
     * @param string $newPassword The new Password
     * @param string $oldPassword The old Password if the account logged isn't an Admin
     * @return boolean
     */
    public function userUpdatePassword($userId, $newPassword, $oldPassword = '')
    {
        $params = [
            'user-id' => $userId,
            'password' => $newPassword,
            'password-verify' => $newPassword,
        ];

        !empty($oldPassword) and $params['password-old'] = $oldPassword;

        try {
            $this->getResponse('user-update-pwd', $params);
            return true;
        } catch (\Exception $ex) {
            return false;
        }
    }

    /**
     * Adds one principal to a group, or removes one principal from a group.
     *
     * See {@link https://helpx.adobe.com/adobe-connect/webservices/group-membership-update.html}
     *
     * @param int $groupId The ID of the group in which you want to add or change member
     * @param int $principalId The ID of the principal whose membership status you want to update
     * @param boolean $isMember Whether the principal is added to (true) or deleted from (false) the group.
     * @return boolean
     */
    public function groupMembershipUpdate($groupId, $principalId, $isMember)
    {
        try {
            $this->getResponse(
                'group-membership-update',
                [
                    'group-id' => $groupId,
                    'principal-id' => $principalId,
                    'is-member' => $isMember,
                ]
            );
            return true;
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
