<?php

namespace AdobeConnectClient\Commands;

use AdobeConnectClient\Commands\CommandAbstract;
use AdobeConnectClient\Converter\Converter;
use AdobeConnectClient\Helpers\StatusValidate;
use AdobeConnectClient\Helpers\SetEntityAttributes as FillObject;
use AdobeConnectClient\CommonInfo as CommonInfoEntity;

/**
 * Gets the common info
 *
 * @see https://helpx.adobe.com/adobe-connect/webservices/common-info.html#common_info
 */
class CommonInfo extends CommandAbstract
{
    /**
     * @return CommonInfo
     */
    public function execute()
    {
        $response = Converter::convert(
            $this->client->getConnection()->get(['action' => 'common-info'])
        );
        StatusValidate::validate($response['status']);
        $commonInfo = new CommonInfoEntity();
        FillObject::setAttributes($commonInfo, $response['common']);
        return $commonInfo;
    }
}
