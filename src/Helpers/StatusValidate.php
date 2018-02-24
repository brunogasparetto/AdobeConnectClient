<?php

namespace AdobeConnectClient\Helpers;

use \AdobeConnectClient\Exceptions\InvalidException;
use \AdobeConnectClient\Exceptions\NoAccessException;
use \AdobeConnectClient\Exceptions\NoDataException;
use \AdobeConnectClient\Exceptions\TooMuchDataException;

/**
 * Validate the status code
 */
abstract class StatusValidate
{
    /**
     * Validate the status code and throw an exception if something is wrong
     *
     * @param array $status
     * @throws InvalidException
     * @throws NoAccessException
     * @throws NoDataException
     * @throws TooMuchDataException
     */
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
