<?php
declare(strict_types=1);

namespace AdobeConnectClient\Commands;

use AdobeConnectClient\Command;
use AdobeConnectClient\Converter\Converter;
use AdobeConnectClient\Helpers\ValueTransform as VT;
use AdobeConnectClient\Helpers\StatusValidate;
use AdobeConnectClient\Helpers\SetEntityAttributes as FillObject;
use AdobeConnectClient\Entities\CommonInfo as CommonInfoEntity;

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
    public function __construct(string $domain = '')
    {
        $this->domain = $domain;
    }

    /**
     * @inheritdoc
     *
     * @return CommonInfoEntity
     */
    protected function process(): CommonInfoEntity
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
