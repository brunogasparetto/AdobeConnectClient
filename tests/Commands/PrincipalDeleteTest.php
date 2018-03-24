<?php

namespace AdobeConnectClient\Tests\Commands;

use AdobeConnectClient\Commands\PrincipalDelete;
use AdobeConnectClient\Exceptions\NoAccessException;

class PrincipalDeleteTest extends TestCommandBase
{
    public function testDeletePrincipal()
    {
        $this->userLogin();

        $command = new PrincipalDelete(1);
        $command->setClient($this->client);

        $this->assertTrue($command->execute());
    }

    public function testNoAccess()
    {
        $this->userLogout();

        $command = new PrincipalDelete(1);
        $command->setClient($this->client);

        $this->expectException(NoAccessException::class);

        $command->execute();
    }

    public function testInvalidDependency()
    {
        $command = new PrincipalDelete(1);

        $this->expectException(\BadMethodCallException::class);

        $command->execute();
    }
}
