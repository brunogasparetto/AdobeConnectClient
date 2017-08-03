<?php

namespace AdobeConnectClient\Commands;

use AdobeConnectClient\CommandAbstract;
use AdobeConnectClient\Client;
use AdobeConnectClient\SCORecord;
use AdobeConnectClient\Converter\Converter;
use AdobeConnectClient\Helpers\StatusValidate;
use AdobeConnectClient\Helpers\SetEntityAttributes as FillObject;

/**
 * Provides a list of recordings (FLV and MP4) for a specified folder or SCO
 *
 * @see https://helpx.adobe.com/adobe-connect/webservices/list-recordings.html
 */
class ListRecordings extends CommandAbstract
{
    /** @var int */
    protected $folderId;

    /**
     * @param Client $client
     * @param int $folderId
     */
    public function __construct(Client $client, $folderId)
    {
        parent::__construct($client);
        $this->folderId = (int) $folderId;
    }

    /**
     * @return SCORecord[]
     */
    public function execute()
    {
        $responseConverted = Converter::convert(
            $this->client->getConnection()->get([
                'folder-id' => $this->folderId,
                'session' => $this->client->getSession()
            ])
        );

        StatusValidate::validate($responseConverted['status']);

        $recordings = [];

        foreach ($responseConverted['recordings'] as $recordingAttributes) {
            $scoRecording = new SCORecord();
            FillObject::setAttributes($scoRecording, $recordingAttributes);
            $recordings[] = $scoRecording;
        }

        return $recordings;
    }
}
