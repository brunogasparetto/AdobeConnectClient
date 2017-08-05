<?php

namespace AdobeConnectClient\Commands;

use AdobeConnectClient\Command;
use AdobeConnectClient\Client;
use AdobeConnectClient\Arrayable;
use AdobeConnectClient\SCO;
use AdobeConnectClient\Converter\Converter;
use AdobeConnectClient\Helpers\StatusValidate;
use AdobeConnectClient\Helpers\SetEntityAttributes as FillObject;

/**
 * Get the SCO Contents from a folder or from other SCO.
 *
 * Use the filter to reduce excessive data returns.
 *
 * @link https://helpx.adobe.com/content/help/en/adobe-connect/webservices/sco-contents.html
 *
 */
class ScoContents extends Command
{
    /** @var array */
    protected $parameters;

    /**
     * @param Client $client
     * @param int $scoId
     * @param Arrayable $filter
     * @param Arrayable $sorter
     */
    public function __construct(
        Client $client,
        $scoId,
        Arrayable $filter = null,
        Arrayable $sorter = null
    ) {
        parent::__construct($client);

        $this->parameters = [
            'action' => 'sco-contents',
            'sco-id' => (int) $scoId,
            'session' => $this->client->getSession()
        ];

        if ($filter) {
            $this->parameters += $filter->toArray();
        }

        if ($sorter) {
            $this->parameters += $sorter->toArray();
        }
    }

    /**
     * @return SCO[]
     */
    public function execute()
    {
        $response = Converter::convert($this->client->getConnection()->get($this->parameters));
        StatusValidate::validate($response['status']);

        $scos = [];

        foreach ($response['scos'] as $scoAttributes) {
            $sco = new SCO;
            FillObject::setAttributes($sco, $scoAttributes);
            $scos[] = $sco;
        }

        return $scos;
    }
}
