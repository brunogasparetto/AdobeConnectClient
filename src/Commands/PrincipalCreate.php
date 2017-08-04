<?php

namespace AdobeConnectClient\Commands;

use AdobeConnectClient\Commands\CommandAbstract;
use AdobeConnectClient\Client;
use AdobeConnectClient\ParameterInterface;
use AdobeConnectClient\Converter\Converter;
use AdobeConnectClient\Helpers\StatusValidate;
use AdobeConnectClient\Helpers\SetEntityAttributes as FillObject;
use AdobeConnectClient\Principal;

/**
 * Create a Principal.
 *
 * @see https://helpx.adobe.com/adobe-connect/webservices/principal-update.html
 */
class PrincipalCreate extends CommandAbstract
{
    /** @var array */
    protected $parameters;

    /**
     * @param Client $client
     * @param ParameterInterface $principal
     */
    public function __construct(Client $client, ParameterInterface $principal)
    {
        parent::__construct($client);

        $this->parameters = [
            'action' => 'principal-update',
            'session' => $this->client->getSession()
        ];

        $this->parameters += $principal->toArray();
    }

    /**
     * @return Principal
     */
    public function execute()
    {
        if (isset($this->parameters['principal-id'])) {
            unset($this->parameters['principal-id']);
        }

        $responseConverted = Converter::convert($this->client->getConnection()->get($this->parameters));

        StatusValidate::validate($responseConverted['status']);

        $principal = new Principal();
        FillObject::setAttributes($principal, $responseConverted['principal']);
        return $principal;
    }
}
