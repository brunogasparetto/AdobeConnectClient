<?php

namespace AdobeConnectClient\Commands;

use AdobeConnectClient\Command;
use AdobeConnectClient\Converter\Converter;
use AdobeConnectClient\Helpers\StatusValidate;

class ScoMove extends Command
{
    /** @var int */
    protected $scoId;

    /** @var int */
    protected $folderId;

    /**
     * @param int $scoId
     * @param int $folderId
     */
    public function __construct($scoId, $folderId)
    {
        $this->scoId = (int) $scoId;
        $this->folderId = (int) $folderId;
    }

    protected function process()
    {
        $response = Converter::convert(
            $this->client->doGet([
                'action' => 'sco-move',
                'sco-id' => $this->scoId,
                'folder-id' => $this->folderId,
                'session' => $this->client->getSession()
            ])
        );

        StatusValidate::validate($response['status']);

        return true;
    }
}
