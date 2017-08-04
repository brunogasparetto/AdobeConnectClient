<?php

namespace AdobeConnectClient\Commands;

use AdobeConnectClient\Commands\CommandAbstract;
use AdobeConnectClient\Client;
use AdobeConnectClient\ParameterInterface;
use AdobeConnectClient\Permission;
use AdobeConnectClient\Converter\Converter;
use AdobeConnectClient\Helpers\StatusValidate;
use AdobeConnectClient\Helpers\SetEntityAttributes as FillObject;

/**
 * Get a list of principals who have permissions to act on a SCO, Principal or Account
 *
 * @see https://helpx.adobe.com/adobe-connect/webservices/permissions-info.html
 */
class PermissionsInfo extends CommandAbstract
{
    /** @var array */
    protected $parameters;

    /**
     * @param Client $client
     * @param int $aclId SCO ID, Principal ID or Account ID
     * @param ParameterInterface $filter
     * @param ParameterInterface $sorter
     */
    public function __construct(Client $client, $aclId, ParameterInterface $filter = null, ParameterInterface $sorter = null)
    {
        parent::__construct($client);

        $this->parameters = [
            'action' => 'permissions-info',
            'acl-id' => (int) $aclId,
            'session' => $client->getSession()
        ];

        if ($filter) {
            $this->parameters += $filter->toArray();
        }

        if ($sorter) {
            $this->parameters += $sorter->toArray();
        }
    }

    /**
     * @return Permission[]
     */
    public function execute()
    {
        $responseConverted = Converter::convert(
            $this->client->getConnection()->get($this->parameters)
        );
        StatusValidate::validate($responseConverted['status']);

        $permissions = [];

        foreach ($responseConverted['permissions'] as $permissionAttributes) {
            $permission = new Permission();
            FillObject::setAttributes($permission, $permissionAttributes);
            $permissions[] = $permission;
        }
        return $permissions;
    }
}
