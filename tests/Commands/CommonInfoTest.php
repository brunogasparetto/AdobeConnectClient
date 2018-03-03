<?php

namespace AdobeConnectClient\Tests\Commands;

use Exception;
use AdobeConnectClient\Commands\CommonInfo;
use AdobeConnectClient\Entities\CommonInfo as CommonInfoEntity;
use AdobeConnectClient\Helpers\SetEntityAttributes;

class CommonInfoTest extends TestCommandBase
{
    public function testExecute()
    {
        $command = new CommonInfo('domain');
        $command->setClient($this->client);
        $commonInfo = $command->execute();

        $this->assertInstanceOf(CommonInfoEntity::class, $commonInfo);

        $expected = new CommonInfoEntity();
        SetEntityAttributes::setAttributes($expected, $this->connection->getLasActionArrayResource());

        $this->assertEquals($expected, $commonInfo);
    }

    public function testException()
    {
        $this->expectException(Exception::class);

        $this->connection->overrideStatusWithNoAccess();

        $command = new CommonInfo();
        $command->setClient($this->client);
        $command->execute();
    }
}
