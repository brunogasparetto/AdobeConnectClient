<?php

namespace AdobeConnectClient\Tests\Commands;

use AdobeConnectClient\Commands\AclFieldUpdate;
use AdobeConnectClient\Parameter;
use AdobeConnectClient\Exceptions\NoAccessException;
use AdobeConnectClient\Exceptions\InvalidException;

class AclFieldUpdateTest extends TestCommandBase
{
    public function testAclFieldUpdate()
    {
        $this->userLogin();

        $extraParams = Parameter::instance()
            ->set('extraField', 'extra value');

        $command = new AclFieldUpdate(1, 'field', 'value', $extraParams);
        $command->setClient($this->client);

        $this->assertTrue($command->execute());
    }

    public function testNoAccess()
    {
        $this->userLogout();

        $extraParams = Parameter::instance()
            ->set('extraField', 'extra value');

        $command = new AclFieldUpdate(1, 'field', 'value', $extraParams);
        $command->setClient($this->client);

        $this->expectException(NoAccessException::class);

        $command->execute();
    }

    public function testInvalid()
    {
        $this->userLogin();

        $extraParams = Parameter::instance()
            ->set('extraField', 'extra value');

        $command = new AclFieldUpdate(1, 'invalid-field', 'value', $extraParams);
        $command->setClient($this->client);

        $this->expectException(InvalidException::class);

        $command->execute();
    }
}
