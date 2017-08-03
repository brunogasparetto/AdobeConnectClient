<?php

namespace AdobeConnectClient\Commands;

use AdobeConnectClient\CommandAbstract;
use AdobeConnectClient\Client;
use AdobeConnectClient\ParameterInterface;
use AdobeConnectClient\SCO;
use AdobeConnectClient\Converter\Converter;
use AdobeConnectClient\Helpers\StatusValidate;
use AdobeConnectClient\Helpers\SetEntityAttributes as FillObject;

/**
 * Get the SCO Contents from a folder or from other SCO.
 *
 * Use the filter to reduce excessive data returns.
 *
 * @see https://helpx.adobe.com/content/help/en/adobe-connect/webservices/sco-contents.html
 *
 */
class ScoContents extends CommandAbstract
{
    /** @var int */
    protected $scoId;

    /** @var ParameterInterface */
    protected $filter;

    /** @var ParameterInterface */
    protected $sorter;

    /**
     * @param Client $client
     * @param int $scoId
     * @param ParameterInterface $filter
     * @param ParameterInterface $sorter
     */
    public function __construct(Client $client, $scoId, ParameterInterface $filter = null, ParameterInterface $sorter = null)
    {
        parent::__construct($client);
        $this->scoId = (int) $scoId;
        $this->filter = $filter;
        $this->sorter = $sorter;
    }

    /**
     * @return SCO[]
     */
    public function execute()
    {
        $parameters = [
            'sco-id' => $this->scoId,
            'session' => $this->client->getSession()
        ];

        if ($this->filter) {
            $parameters += $this->filter->toArray();
        }

        if ($this->sorter) {
            $parameters += $this->sorter->toArray();
        }

        $responseConverted = Converter::convert($this->client->getConnection()->get($parameters));

        StatusValidate::validate($responseConverted['status']);

        unset($parameters);

        $scos = [];

        foreach ($responseConverted['scos'] as $scoAttributes) {
            $sco = new SCO();
            FillObject::setAttributes($sco, $scoAttributes);
            $scos[] = $sco;
        }

        return $scos;
    }
}
