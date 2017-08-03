<?php

namespace AdobeConnectClient\Helpers;

use AdobeConnectClient\Exceptions\InvalidException;
use AdobeConnectClient\Exceptions\NoAccessException;
use AdobeConnectClient\Exceptions\NoDataException;
use AdobeConnectClient\Exceptions\TooMuchDataException;

abstract class StatusValidate
{
    public static function validate(array $status)
    {
        switch ($status['code']) {
            case 'invalid':
                $invalid = $status['invalid'];
                throw new InvalidException(
                    "{$invalid['field']} {$invalid['subcode']}"
                );

            case 'no-access':
                throw new NoAccessException($status['subcode']);

            case 'no-data':
                throw new NoDataException();

            case 'too-much-data':
                throw new TooMuchDataException();
        }
    }
}
