<?php

namespace AdobeConnectClient\Commands;

use AdobeConnectClient\Command;
use AdobeConnectClient\ArrayableInterface;
use AdobeConnectClient\Converter\Converter;
use AdobeConnectClient\Entities\SCO;
use AdobeConnectClient\Helpers\StatusValidate;
use AdobeConnectClient\Helpers\SetEntityAttributes as FillObject;

/**
 * Provides a complete list of users and groups, including primary groups.
 *
 * More info see {@link https://helpx.adobe.com/adobe-connect/webservices/sco-expanded-contents.html}
 */
class ScoExpandedContents extends Command
{
    /**
     * @var int
     */
    protected $scoId;

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
            'action' => 'sco-expanded-contents',
        ];

        $this->scoId = intval($scoId);

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
                $this->parameters + ['sco-id' => $this->scoId, 'session' => $this->client->getSession()]
            )
        );

        StatusValidate::validate($response['status']);

        $scos = [];

        foreach ($response['expandedScos'] as $attributes) {
            $sco = new SCO();
            FillObject::setAttributes($sco, $attributes);
            $scos[] = $sco;
        }

        return $scos;
    }
}
