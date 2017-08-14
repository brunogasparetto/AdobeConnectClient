<?php

namespace AdobeConnectClient\Commands;

use AdobeConnectClient\Command;
use AdobeConnectClient\Converter\Converter;
use AdobeConnectClient\Helpers\StatusValidate;
use AdobeConnectClient\Helpers\BooleanTransform as BT;
use AdobeConnectClient\Helpers\StringCaseTransform as SCT;

/**
 * Set a feature
 *
 * @link https://helpx.adobe.com/adobe-connect/webservices/meeting-feature-update.html
 */
class MeetingFeatureUpdate extends Command
{
    /** @var array */
    protected $parameters;

    /**
     * @param int $accountId
     * @param string $featureId
     * @param bool $enable
     */
    public function __construct($accountId, $featureId, $enable)
    {
        $this->parameters = [
            'action' => 'meeting-feature-update',
            'account-id' => (int) $accountId,
            'enable' => BT::toString($enable),
        ];

        $featureId = SCT::toHyphen($featureId);

        if (mb_strpos($featureId, 'fid-') === false) {
            $featureId = 'fid-' . $featureId;
        }

        $this->parameters['feature-id'] = $featureId;
    }

    protected function process()
    {
        $response = Converter::convert(
            $this->client->getConnection()->get(
                $this->parameters + ['session' => $this->client->getSession()]
            )
        );
        StatusValidate::validate($response['status']);
        return true;
    }
}
