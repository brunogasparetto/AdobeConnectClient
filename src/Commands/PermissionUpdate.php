<?php

namespace AdobeConnectClient\Commands;

use AdobeConnectClient\Command;
use AdobeConnectClient\Client;
use AdobeConnectClient\ParameterInterface;
use AdobeConnectClient\Converter\Converter;
use AdobeConnectClient\Helpers\StatusValidate;

/**
 * Updates the principal's permissions to access a SCO or the access mode if the acl-id is a Meeting
 *
 * @see https://helpx.adobe.com/adobe-connect/webservices/permissions-update.html
 * @see https://helpx.adobe.com/adobe-connect/webservices/common-xml-elements-attributes.html#permission_id for SCO access mode
 */
class PermissionUpdate extends Command
{
    /** @var array */
    protected $parameters;

    public function __construct(Client $client, ParameterInterface $permission)
    {
        parent::__construct($client);

        $this->parameters = [
            'action' => 'permissions-update',
            'session' => $client->getSession()
        ];

        $this->parameters += $permission->toArray();
    }

    /**
     * @return bool
     */
    public function execute()
    {
        $responseConverted = Converter::convert(
            $this->client->getConnection()->get($this->parameters)
        );
        StatusValidate::validate($responseConverted['status']);
        return true;
    }
}
