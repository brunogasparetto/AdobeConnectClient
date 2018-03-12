<?php

namespace AdobeConnectClient\Tests\Commands;

use AdobeConnectClient\Commands\ScoDelete;
use AdobeConnectClient\Exceptions\NoAccessException;

class ScoDeleteTest extends TestCommandBase
{
    public function testNoAccess()
    {
        $this->userLogout();

        $command = new ScoDelete(1);
        $command->setClient($this->client);

        $this->expectException(NoAccessException::class);

        $command->execute();
    }

    public function testDelete()
    {
        $this->userLogin();

        $command = new ScoDelete(1);
        $command->setClient($this->client);

        $this->assertTrue($command->execute());
    }

    public function testInvalidDependency()
    {
        $command = new ScoDelete(1);

        $this->expectException(\BadMethodCallException::class);

        $command->execute();
    }
}
