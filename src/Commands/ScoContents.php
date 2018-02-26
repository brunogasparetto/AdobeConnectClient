<?php

namespace AdobeConnectClient\Commands;

use AdobeConnectClient\Command;
use AdobeConnectClient\ArrayableInterface;
use AdobeConnectClient\Entities\SCO;
use AdobeConnectClient\Converter\Converter;
use AdobeConnectClient\Helpers\StatusValidate;
use AdobeConnectClient\Helpers\SetEntityAttributes as FillObject;

/**
 * Get the SCO Contents from a folder or from other SCO.
 *
 * Use the filter to reduce excessive data returns.
 *
 * More info see {@link https://helpx.adobe.com/content/help/en/adobe-connect/webservices/sco-contents.html}
 *
 */
class ScoContents extends Command
{
    /**
     * @var array
     */
    protected $parameters;

    /**
     * @param int $scoId
     * @param ArrayableInterface|null $filter
     * @param ArrayableInterface|null $sorter
     */
    public function __construct(
        $scoId,
        ArrayableInterface $filter = null,
        ArrayableInterface $sorter = null
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
     * @inheritdoc
     *
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
