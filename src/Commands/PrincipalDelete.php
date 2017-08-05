<?php

namespace AdobeConnectClient\Commands;

use AdobeConnectClient\Command;
use AdobeConnectClient\Client;
use AdobeConnectClient\Converter\Converter;
use AdobeConnectClient\Helpers\StatusValidate;

/**
 * Remove one principal, either user or group.
 *
 * @link https://helpx.adobe.com/adobe-connect/webservices/principals-delete.html
 */
class PrincipalDelete extends Command
{
    /** @var int */
    protected $principalId;

    public function __construct(Client $client, $principalId)
    {
        parent::__construct($client);
        $this->principalId = (int) $principalId;
    }

    /**
     * @return bool
     */
    public function execute()
    {
        $responseConverted = Converter::convert(
            $this->client->getConnection()->get([
                'action' => 'principals-delete',
                'principal-id' => $this->principalId,
                'session' => $this->client->getSession()
            ])
        );

        StatusValidate::validate($responseConverted['status']);

        return true;
    }
}
