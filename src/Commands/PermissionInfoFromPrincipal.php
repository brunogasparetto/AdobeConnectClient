<?php

namespace AdobeConnectClient\Commands;

use AdobeConnectClient\Command;
use AdobeConnectClient\Client;
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
     * @param Client $client
     * @param int $aclId
     * @param int $principalId
     */
    public function __construct(Client $client, $aclId, $principalId)
    {
        parent::__construct($client);
        $this->aclId = (int) $aclId;
        $this->principalId = (int) $principalId;
    }

    /**
     * @return Permission
     */
    public function execute()
    {
        $response = Converter::convert(
            $this->client->getConnection()->get([
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
