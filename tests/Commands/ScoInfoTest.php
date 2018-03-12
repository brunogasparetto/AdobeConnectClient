<?php

namespace AdobeConnectClient\Tests\Commands;

use AdobeConnectClient\Commands\ScoInfo;
use AdobeConnectClient\Entities\SCO;
use AdobeConnectClient\Exceptions\NoAccessException;

class ScoInfoTest extends TestCommandBase
{
    public function testNoAccess()
    {
        $this->userLogout();

        $command = new ScoInfo(1);
        $command->setClient($this->client);

        $this->expectException(NoAccessException::class);

        $command->execute();
    }

    public function testInfo()
    {
        $this->userLogin();

        $command = new ScoInfo(1);
        $command->setClient($this->client);

        $sco = $command->execute();

        $this->assertInstanceOf(SCO::class, $sco);
        $this->assertEquals(624520, $sco->getAccountId());
        $this->assertEquals(2006320683, $sco->getScoId());
    }
}
