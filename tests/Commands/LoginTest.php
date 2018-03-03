<?php

namespace AdobeConnectClient\Tests\Commands;

use AdobeConnectClient\Commands\Login;

class LoginTest extends TestCommandBase
{
    /**
     * return string
     */
    public function testExecute()
    {
        $command = new Login('login', 'password');
        $command->setClient($this->client);

        $this->assertTrue($command->execute());

        return $this->client->getSession();
    }

    /**
     * @depends testExecute
     *
     * @param string $session
     */
    public function testLoggedSession($session)
    {
        $this->assertEquals($this->connection->getSessionString(), $session);
    }

    public function testInvalidLogin()
    {
        $this->connection->overrideStatusWithNoData();

        $command = new Login('login', 'password');
        $command->setClient($this->client);

        $this->assertFalse($command->execute());
    }
}
