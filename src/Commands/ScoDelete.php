<?php
declare(strict_types=1);

namespace AdobeConnectClient\Commands;

use AdobeConnectClient\Command;
use AdobeConnectClient\Converter\Converter;
use AdobeConnectClient\Helpers\StatusValidate;

/**
 * Deletes one or more objects (SCOs).
*
* More info see {@link https://helpx.adobe.com/adobe-connect/webservices/sco-delete.html}
 */
class ScoDelete extends Command
{
    /**
     * @var int
     */
    protected $scoId;

    /**
     *
     * @param int $scoId The SCO ID or Folder ID
     */
    public function __construct(int $scoId)
    {
        $this->scoId = $scoId;
    }

    /**
     * @inheritdoc
     *
     * @return bool
     */
    protected function process(): bool
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
