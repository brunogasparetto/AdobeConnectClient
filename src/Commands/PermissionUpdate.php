<?php

namespace AdobeConnectClient\Commands;

use AdobeConnectClient\Command;
use AdobeConnectClient\Arrayable;
use AdobeConnectClient\Converter\Converter;
use AdobeConnectClient\Helpers\StatusValidate;

/**
 * Updates the principal's permissions to access a SCO or the access mode if the acl-id is a Meeting
 *
 * More info see {@link https://helpx.adobe.com/adobe-connect/webservices/permissions-update.html}
 * For SCO access mode info see {@link https://helpx.adobe.com/adobe-connect/webservices/common-xml-elements-attributes.html#permission_id}
 */
class PermissionUpdate extends Command
{
    /**
     * @var array
     */
    protected $parameters;

    /**
     * @param Arrayable $permission
     */
    public function __construct(Arrayable $permission)
    {
        $this->parameters = [
            'action' => 'permissions-update',
        ];

        $this->parameters += $permission->toArray();
    }

    /**
     * @return bool
     */
    protected function process()
    {
        $response = Converter::convert(
            $this->client->doGet(
                $this->parameters + ['session' => $this->client->getSession()]
            )
        );
        StatusValidate::validate($response['status']);
        return true;
    }
}
