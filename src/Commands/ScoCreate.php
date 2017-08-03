<?php

namespace AdobeConnectClient\Commands;

use AdobeConnectClient\CommandAbstract;
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
    protected $sco;

    public function __construct(Client $client, ParameterInterface $sco)
    {
        parent::__construct($client);
        $this->sco = $sco;
    }

    /**
     * @return SCO
     */
    public function execute()
    {
        $parameters = $this->sco->toArray();

        // Create a SCO only in a folder
        if (isset($parameters['sco-id'])) {
            unset($parameters['sco-id']);
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

        $sco = new SCO();
        FillObject::setAttributes($sco, $responseConverted['sco']);
        return $sco;
    }
}
