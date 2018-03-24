<?php

namespace AdobeConnectClient\Tests\Commands;

use AdobeConnectClient\Commands\CommonInfo;
use AdobeConnectClient\Entities\CommonInfo as CommonInfoEntity;

class CommonInfoTest extends TestCommandBase
{
    public function testWithoutDomain()
    {
        $command = new CommonInfo();
        $command->setClient($this->client);
        $commonInfo = $command->execute();

        $this->assertInstanceOf(CommonInfoEntity::class, $commonInfo);
        $this->assertEquals('https:example.com', $commonInfo->getHost());
        $this->assertEquals(624520, $commonInfo->getAccountId());
    }

    public function testWithDomain()
    {
        $command = new CommonInfo('domain');
        $command->setClient($this->client);
        $commonInfo = $command->execute();

        $this->assertInstanceOf(CommonInfoEntity::class, $commonInfo);
        $this->assertEquals('https:example.com', $commonInfo->getHost());
        $this->assertEquals(624520, $commonInfo->getAccountId());
    }

    public function testInvalidDependency()
    {
        $command = new CommonInfo();

        $this->expectException(\BadMethodCallException::class);

        $command->execute();
    }
}
