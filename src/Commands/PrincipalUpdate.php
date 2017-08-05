<?php

namespace AdobeConnectClient\Commands;

use AdobeConnectClient\Command;
use AdobeConnectClient\Client;
use AdobeConnectClient\Arrayable;
use AdobeConnectClient\Converter\Converter;
use AdobeConnectClient\Helpers\StatusValidate;

/**
 * Update a Principal.
 *
 * @link https://helpx.adobe.com/adobe-connect/webservices/principal-update.html
 */
class PrincipalUpdate extends Command
{
    /** @var array */
    protected $parameters;

    /**
     * @param Client $client
     * @param Arrayable $principal
     */
    public function __construct(Client $client, Arrayable $principal)
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
