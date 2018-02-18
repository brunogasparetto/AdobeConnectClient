<?php

namespace AdobeConnectClient\Commands;

use AdobeConnectClient\Command;
use AdobeConnectClient\Converter\Converter;
use AdobeConnectClient\Helpers\StatusValidate;

/**
 * Deletes one or more objects (SCOs).
*
* @link https://helpx.adobe.com/adobe-connect/webservices/sco-delete.html
 */
class ScoDelete extends Command
{
    /** @var int */
    protected $scoId;

    /**
     *
     * @param int $scoId The SCO ID or Folder ID
     */
    public function __construct($scoId)
    {
        $this->scoId = (int) $scoId;
    }

    /**
     * @return bool
     */
    protected function process()
    {
        $response = Converter::convert(
            $this->client->doGet([
                'action' => 'sco-delete',
                'sco-id' => $this->scoId,
                'session' => $this->client->getSession()
            ])
        );

        StatusValidate::validate($response['status']);

        return true;
    }
}
