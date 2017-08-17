<?php

namespace AdobeConnectClient\Commands;

use AdobeConnectClient\Command;
use AdobeConnectClient\Arrayable;
use AdobeConnectClient\Converter\Converter;
use AdobeConnectClient\Helpers\StatusValidate;
use AdobeConnectClient\Helpers\SetEntityAttributes as FillObject;
use AdobeConnectClient\Principal;

/**
 * Create a Principal.
 *
 * @link https://helpx.adobe.com/adobe-connect/webservices/principal-update.html
 */
class PrincipalCreate extends Command
{
    /** @var array */
    protected $parameters;

    /**
     * @param Arrayable $principal
     */
    public function __construct(Arrayable $principal)
    {
        $this->parameters = [
            'action' => 'principal-update',
        ];

        $this->parameters += $principal->toArray();
    }

    /**
     * @return Principal
     */
    protected function process()
    {
        if (isset($this->parameters['principal-id'])) {
            unset($this->parameters['principal-id']);
        }

        $response = Converter::convert(
            $this->client->doGet(
                $this->parameters + ['session' => $this->client->getSession()]
            )
        );

        StatusValidate::validate($response['status']);

        $principal = new Principal();
        FillObject::setAttributes($principal, $response['principal']);
        return $principal;
    }
}
