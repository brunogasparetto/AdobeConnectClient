<?php

namespace AdobeConnectClient\Commands;

use AdobeConnectClient\Command;
use AdobeConnectClient\ArrayableInterface;
use AdobeConnectClient\Converter\Converter;
use AdobeConnectClient\Exceptions\InvalidException;
use AdobeConnectClient\Helpers\StatusValidate;

/**
 * Update a SCO.
 *
 * More info see {@link https://helpx.adobe.com/adobe-connect/webservices/sco-update.html}
 */
class ScoUpdate extends Command
{
    /**
     * @var array
     */
    protected $parameters;

    /**
     * @param ArrayableInterface $sco
     * @throws InvalidException
     */
    public function __construct(ArrayableInterface $sco)
    {
        $this->parameters = [
            'action' => 'sco-update',
        ];

        $this->parameters += $sco->toArray();

        if (empty($this->parameters['sco-id'])) {
            throw new InvalidException('sco-id is missing');
        }
    }

    /**
     * @inheritdoc
     *
     * @return bool
     */
    protected function process()
    {
        // Only use the SCO ID. To change Folder use scoMove
        if (isset($this->parameters['folder-id'])) {
            unset($this->parameters['folder-id']);
        }

        $response = Converter::convert(
            $this->client->doGet(
                $this->parameters + ['session' => $this->client->getSession()]
            )
        );
        StatusValidate::validate($response['status']);
        return true;
    }
}
