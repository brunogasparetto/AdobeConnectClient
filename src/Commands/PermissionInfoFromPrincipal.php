<?php

namespace AdobeConnectClient\Commands;

use AdobeConnectClient\Command;
use AdobeConnectClient\Permission;
use AdobeConnectClient\Converter\Converter;
use AdobeConnectClient\Helpers\StatusValidate;
use AdobeConnectClient\Helpers\SetEntityAttributes as FillObject;

/**
 * Get the Principal's permission in a SCO, Principal or Account
 *
 * @link https://helpx.adobe.com/adobe-connect/webservices/permissions-info.html
 */
class PermissionInfoFromPrincipal extends Command
{
    /** @var int */
    protected $aclId;

    /** @var int */
    protected $principalId;

    /**
     * @param int $aclId
     * @param int $principalId
     */
    public function __construct($aclId, $principalId)
    {
        $this->aclId = (int) $aclId;
        $this->principalId = (int) $principalId;
    }

    /**
     * @return Permission
     */
    protected function process()
    {
        $response = Converter::convert(
            $this->client->doGet([
                'action' => 'permissions-info',
                'acl-id' => $this->aclId,
                'principal-id' => $this->principalId,
                'session' => $this->client->getSession()
            ])
        );
        StatusValidate::validate($response['status']);
        $permission = new Permission();
        FillObject::setAttributes($permission, $response['permission']);
        return $permission;
    }
}
