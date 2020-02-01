<?php

namespace AdobeConnectClient\Commands;

use AdobeConnectClient\Command;
use AdobeConnectClient\Entities\SCORecord;
use AdobeConnectClient\Converter\Converter;
use AdobeConnectClient\Helpers\StatusValidate;
use AdobeConnectClient\Helpers\SetEntityAttributes as FillObject;

/**
 * Provides a list of recordings (FLV and MP4) for a specified folder or SCO
 *
 * More info see {@link https://helpx.adobe.com/adobe-connect/webservices/list-recordings.html}
 */
class ListRecordings extends Command
{
    /**
     * @var int
     */
    protected $folderId;

    /**
     * @param int $folderId
     */
    public function __construct($folderId)
    {
        $this->folderId = $folderId;
    }

    /**
     * @inheritdoc
     *
     * @return SCORecord[]
     */
    protected function process()
    {
        $response = Converter::convert(
            $this->client->doGet([
                'action' => 'list-recordings',
                'folder-id' => $this->folderId,
                'session' => $this->client->getSession()
            ])
        );

        StatusValidate::validate($response['status']);

        $recordings = [];

        foreach ($response['recordings'] as $recordingAttributes) {
            $scoRecording = new SCORecord();
            FillObject::setAttributes($scoRecording, $recordingAttributes);
            $recordings[] = $scoRecording;
        }

        return $recordings;
    }
}
