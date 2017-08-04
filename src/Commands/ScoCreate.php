<?php

namespace AdobeConnectClient\Commands;

use AdobeConnectClient\Commands\CommandAbstract;
use AdobeConnectClient\Client;
use AdobeConnectClient\ParameterInterface;
use AdobeConnectClient\SCO;
use AdobeConnectClient\Converter\Converter;
use AdobeConnectClient\Helpers\StatusValidate;
use AdobeConnectClient\Helpers\SetEntityAttributes as FillObject;

/**
 * Create a SCO.
 *
 * @see https://helpx.adobe.com/adobe-connect/webservices/sco-update.html
 */
class ScoCreate extends CommandAbstract
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
     * @return SCO
     */
    public function execute()
    {
        // Create a SCO only in a folder
        if (isset($this->parameters['sco-id'])) {
            unset($this->parameters['sco-id']);
        }

        $responseConverted = Converter::convert($this->client->getConnection()->get($this->parameters));

        StatusValidate::validate($responseConverted['status']);

        $sco = new SCO();
        FillObject::setAttributes($sco, $responseConverted['sco']);
        return $sco;
    }
}
