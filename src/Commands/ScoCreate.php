<?php

namespace AdobeConnectClient\Commands;

use AdobeConnectClient\Command;
use AdobeConnectClient\Arrayable;
use AdobeConnectClient\SCO;
use AdobeConnectClient\Converter\Converter;
use AdobeConnectClient\Helpers\StatusValidate;
use AdobeConnectClient\Helpers\SetEntityAttributes as FillObject;

/**
 * Create a SCO.
 *
 * @link https://helpx.adobe.com/adobe-connect/webservices/sco-update.html
 */
class ScoCreate extends Command
{
    /** @var array */
    protected $parameters;

    /**
     * @param Arrayable $sco
     */
    public function __construct(Arrayable $sco)
    {
        $this->parameters = [
            'action' => 'sco-update',
        ];

        $this->parameters += $sco->toArray();
    }

    /**
     * @return SCO
     */
    protected function process()
    {
        // Create a SCO only in a folder
        if (isset($this->parameters['sco-id'])) {
            unset($this->parameters['sco-id']);
        }

        $response = Converter::convert(
            $this->client->doGet(
                $this->parameters + ['session' => $this->client->getSession()]
            )
        );

        StatusValidate::validate($response['status']);

        $sco = new SCO();
        FillObject::setAttributes($sco, $response['sco']);
        return $sco;
    }
}
