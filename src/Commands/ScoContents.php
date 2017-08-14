<?php

namespace AdobeConnectClient\Commands;

use AdobeConnectClient\Command;
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
     * @param int $scoId
     * @param Arrayable $filter
     * @param Arrayable $sorter
     */
    public function __construct(
        $scoId,
        Arrayable $filter = null,
        Arrayable $sorter = null
    ) {
        $this->parameters = [
            'action' => 'sco-contents',
            'sco-id' => (int) $scoId,
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
    protected function process()
    {
        $response = Converter::convert(
            $this->client->doGet(
                $this->parameters + ['session' => $this->client->getSession()]
            )
        );
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
