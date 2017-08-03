<?php

namespace AdobeConnectClient\Commands;

use AdobeConnectClient\CommandAbstract;
use AdobeConnectClient\Client;
use AdobeConnectClient\ParameterInterface;
use AdobeConnectClient\Converter\Converter;
use AdobeConnectClient\Helpers\StatusValidate;

/**
 * Update a Principal.
 *
 * @see https://helpx.adobe.com/adobe-connect/webservices/principal-update.html
 */
class PrincipalUpdate extends CommandAbstract
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
     * @return bool
     */
    public function execute()
    {
        foreach (['password', 'type', 'has-children'] as $prohibited) {
            if (isset($this->parameters[$prohibited])) {
                unset($this->parameters[$prohibited]);
            }
        }

        $responseConverted = Converter::convert($this->client->getConnection()->get($this->parameters));
        StatusValidate::validate($responseConverted['status']);
        return true;
    }
}
