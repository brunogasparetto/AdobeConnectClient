<?php

namespace AdobeConnectClient\Commands;

use AdobeConnectClient\CommandAbstract;
use AdobeConnectClient\Converter\Converter;
use AdobeConnectClient\Helper\StatusValidate;
use AdobeConnectClient\Helper\SetEntityAttributes;
use AdobeConnectClient\CommonInfo;

class CommonInfo extends CommandAbstract
{
    /**
     *
     * @return CommonInfo
     */
    public function execute()
    {
        $response = Converter::convert(
            $this->client->getConnection()->get(['action' => 'common-info'])
        );
        StatusValidate::validate($response['status']);
        $commonInfo = new CommonInfo();
        SetEntityAttributes::setAttributes($commonInfo, $response['common']);
        return $commonInfo;
    }

}
