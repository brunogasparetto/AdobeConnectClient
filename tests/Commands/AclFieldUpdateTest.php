<?php

namespace AdobeConnectClient\Tests\Commands;

use Exception;
use AdobeConnectClient\Commands\AclFieldUpdate;
use AdobeConnectClient\Parameter;

class AclFieldUpdateTest extends TestCommandBase
{
    public function testExecute()
    {
        $extraParams = Parameter::instance()
            ->set('extraField', 'extra value');

        $command = new AclFieldUpdate(1, 'field', 'value', $extraParams);
        $command->setClient($this->client);

        $this->assertTrue($command->execute());
    }

    public function testException()
    {
        $this->expectException(Exception::class);

        $this->connection->overrideStatusWithNoAccess();

        $command = new AclFieldUpdate(1, 'field', 'value');
        $command->setClient($this->client);
        $command->execute();
    }
}
