<?php

namespace AdobeConnectClient\Tests\Commands;

use AdobeConnectClient\Commands\Logout;

class LogoutTest extends TestCommandBase
{
    /**
     * return string
     */
    public function testExecute()
    {
        $command = new Logout();
        $command->setClient($this->client);

        $this->assertTrue($command->execute());

        return $this->client->getSession();
    }

    /**
     * @depends testExecute
     *
     * @param string $session
     */
    public function testLogoutSession($session)
    {
        $this->assertEquals('', $session);
    }
}
