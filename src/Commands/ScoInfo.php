<?php
declare(strict_types=1);

namespace AdobeConnectClient\Commands;

use AdobeConnectClient\Command;
use AdobeConnectClient\Entities\SCO;
use AdobeConnectClient\Converter\Converter;
use AdobeConnectClient\Helpers\StatusValidate;
use AdobeConnectClient\Helpers\SetEntityAttributes as FillObject;

/**
 * Gets the Sco info
 *
 * More info see {@link https://helpx.adobe.com/adobe-connect/webservices/sco-info.html}
 */
class ScoInfo extends Command
{
    /**
     * @var int
     */
    protected $scoId;

    /**
     * @param int $scoId
     */
    public function __construct(int $scoId)
    {
        $this->scoId = $scoId;
    }

    /**
     * @inheritdoc
     *
     * @return SCO
     */
    protected function process(): SCO
    {
        $response = Converter::convert(
            $this->client->doGet([
                'action' => 'sco-info',
                'sco-id' => $this->scoId,
                'session' => $this->client->getSession()
            ])
        );
        StatusValidate::validate($response['status']);
        $sco = new SCO();
        FillObject::setAttributes($sco, $response['sco']);
        return $sco;
    }
}
