<?php

namespace AdobeConnectClient\Commands;

use AdobeConnectClient\Commands\CommandAbstract;
use AdobeConnectClient\Client;
use AdobeConnectClient\ParameterInterface;
use AdobeConnectClient\Converter\Converter;
use AdobeConnectClient\Helpers\StatusValidate;

/**
 * Update a SCO.
 *
 * @see https://helpx.adobe.com/adobe-connect/webservices/sco-update.html
 */
class ScoUpdate extends CommandAbstract
{
    /** @var ParameterInterface */
    protected $parameters;

    public function __construct(Client $client, ParameterInterface $sco)
    {
        parent::__construct($client);

        $this->parameters = [
            'action' => 'sco-update',
            'session' => $this->client->getSession()
        ];

        $this->parameters += $sco->toArray();
    }

    /**
     * @return bool
     */
    public function execute()
    {
        // Only use the SCO ID. To change Folder use scoMove
        if (isset($this->parameters['folder-id'])) {
            unset($this->parameters['folder-id']);
        }

        $responseConverted = Converter::convert($this->client->getConnection()->get($this->parameters));
        StatusValidate::validate($responseConverted['status']);
        return true;
    }
}
