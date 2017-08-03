<?php

namespace AdobeConnectClient\Commands;

use AdobeConnectClient\CommandAbstract;
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
    protected $sco;

    public function __construct(Client $client, ParameterInterface $sco)
    {
        parent::__construct($client);
        $this->sco = $sco;
    }

    /**
     * @return bool
     */
    public function execute()
    {
        $parameters = $this->sco->toArray();

        // Only use the SCO ID. To change Folder use scoMove
        if (isset($parameters['folder-id'])) {
            unset($parameters['folder-id']);
        }

        $responseConverted = Converter::convert(
            $this->client->getConnection()->get(
                [
                    'action' => 'sco-update',
                    'session' => $this->client->getSession()
                ]
                +
                $parameters
            )
        );

        StatusValidate::validate($responseConverted['status']);
        return true;
    }
}
