<?php

namespace AdobeConnectClient\Commands;

use AdobeConnectClient\CommandAbstract;
use AdobeConnectClient\Client;
use AdobeConnectClient\Converter\Converter;
use AdobeConnectClient\Helpers\StatusValidate;

/**
 * Deletes one or more objects (SCOs).
*
* @see https://helpx.adobe.com/adobe-connect/webservices/sco-delete.html
 */
class ScoDelete extends CommandAbstract
{
    /** @var int */
    protected $scoId;

    /**
     *
     * @param Client $client
     * @param int $scoId The SCO ID or Folder ID
     */
    public function __construct(Client $client, $scoId)
    {
        parent::__construct($client);
        $this->scoId = (int) $scoId;
    }

    /**
     * @return boolean
     */
    public function execute()
    {
        $responseConverted = Converter::convert(
            $this->client->getConnection()->get([
                'action' => 'sco-delete',
                'sco-id' => $this->scoId,
                'session' => $this->client->getSession()
            ])
        );

        StatusValidate::validate($responseConverted['status']);

        return true;
    }
}
