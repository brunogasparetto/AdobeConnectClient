<?php

namespace AdobeConnectClient\Helper;

abstract class StatusValidate
{
    public static function validate(array $status)
    {
        switch ($status['code']) {
            case 'invalid':
                $invalid = $status['invalid'];
                throw new \AdobeConnectClient\Exception\InvalidException(
                    "{$invalid['field']} {$invalid['subcode']}"
                );

            case 'no-access':
                throw new \AdobeConnectClient\Exception\NoAccessException($status['subcode']);

            case 'no-data':
                throw new \AdobeConnectClient\Exception\NoDataException();

            case 'too-much-data':
                throw new \AdobeConnectClient\Exception\TooMuchDataException();
        }
    }
}
