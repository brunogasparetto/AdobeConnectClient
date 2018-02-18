<?php

namespace AdobeConnectClient\Commands;

use AdobeConnectClient\Command;
use AdobeConnectClient\Converter\Converter;
use AdobeConnectClient\Helpers\ValueTransform as VT;
use AdobeConnectClient\Helpers\StatusValidate;
use AdobeConnectClient\Helpers\SetEntityAttributes as FillObject;
use AdobeConnectClient\CommonInfo as CommonInfoEntity;

/**
 * Gets the common info
 *
 * More info see {@link https://helpx.adobe.com/adobe-connect/webservices/common-info.html#common_info}
 */
class CommonInfo extends Command
{
    /**
     * @var string
     */
    protected $domain = '';

    /**
     * @param string $domain
     */
    public function __construct($domain = '')
    {
        $this->domain = $domain;
    }
    /**
     * @return CommonInfo
     */
    protected function process()
    {

        $parameters = [
            'action' => 'common-info'
        ];

        if (!empty($this->domain)) {
            $parameters += [
                'domain' => VT::toString($this->domain)
            ];
        }

        $response = Converter::convert(
            $this->client->doGet($parameters)
        );
        StatusValidate::validate($response['status']);
        $commonInfo = new CommonInfoEntity();
        FillObject::setAttributes($commonInfo, $response['common']);
        return $commonInfo;
    }
}
