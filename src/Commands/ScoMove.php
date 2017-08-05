<?php

namespace AdobeConnectClient\Commands;

use AdobeConnectClient\Command;
use AdobeConnectClient\Client;
use AdobeConnectClient\ParameterInterface;
use AdobeConnectClient\Converter\Converter;
use AdobeConnectClient\Helpers\StatusValidate;

class ScoMove extends Command
{
    /** @var int */
    protected $scoId;

    /** @var int */
    protected $folderId;

    /**
     * @param Client $client
     * @param int $scoId
     * @param int $folderId
     */
    public function __construct(Client $client, $scoId, $folderId)
    {
        parent::__construct($client);
        $this->scoId = (int) $scoId;
        $this->folderId = (int) $folderId;
    }

    public function execute()
    {
        $responseConverted = Converter::convert(
            $this->client->getConnection()->get([
                'action' => 'sco-move',
                'sco-id' => $this->scoId,
                'folder-id' => $this->folderId,
                'session' => $this->client->getSession()
            ])
        );

        StatusValidate::validate($responseConverted['status']);

        return true;
    }
}
