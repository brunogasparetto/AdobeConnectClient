<?php

use \PHPUnit\Framework\TestCase;
use \AdobeConnectClient\Helpers\StatusValidate;
use \AdobeConnectClient\Exceptions\InvalidException;
use \AdobeConnectClient\Exceptions\NoAccessException;
use \AdobeConnectClient\Exceptions\NoDataException;
use \AdobeConnectClient\Exceptions\TooMuchDataException;

class StatusValidateTest extends TestCase
{
    public function testInvalid()
    {
        $this->expectException(InvalidException::class);

        $status = [
            'code' => 'invalid',
            'invalid' => [
                'field' => 'login',
                'subcode' => 'Missing login'
            ]
        ];

        StatusValidate::validate($status);
    }

    public function testNoAccess()
    {
        $this->expectException(NoAccessException::class);

        $status = [
            'code' => 'no-access',
            'subcode' => 'Access Denied'
        ];

        StatusValidate::validate($status);
    }

    public function testNoData()
    {
        $this->expectException(NoDataException::class);

        $status = [
            'code' => 'no-data'
        ];

        StatusValidate::validate($status);
    }

    public function testTooMuchData()
    {
        $this->expectException(TooMuchDataException::class);

        $status = [
            'code' => 'too-much-data'
        ];

        StatusValidate::validate($status);
    }

    public function testValid()
    {
        $status = [
            'code' => 'ok'
        ];

        $this->assertNull(StatusValidate::validate($status));
    }

    public function testStatusCodeNotImplemented()
    {
        $this->expectException(DomainException::class);

        $status = [
            'code' => 'status-code-not-implemented'
        ];

        StatusValidate::validate($status);
    }


}