<?php

namespace AdobeConnectClient\Tests\Commands;

use AdobeConnectClient\Commands\ListRecordings;
use AdobeConnectClient\Entities\SCORecord;
use AdobeConnectClient\Exceptions\NoDataException;
use AdobeConnectClient\Exceptions\NoAccessException;

class ListRecordingsTest extends TestCommandBase
{
    public function testListSuccess()
    {
        $this->userLogin();

        $command = new ListRecordings(1);
        $command->setClient($this->client);

        $records = $command->execute();

        $this->assertNotEmpty($records);

        $record = reset($records);

        $this->assertInstanceOf(SCORecord::class, $record);
        $this->assertEquals(13633, $record->getScoId());
        $this->assertEquals('content_test', $record->getName());
    }

    public function testNoData()
    {
        $this->userLogin();

        $command = new ListRecordings(5);
        $command->setClient($this->client);

        $this->expectException(NoDataException::class);

        $command->execute();
    }

    public function testNoAccess()
    {
        $this->userLogout();

        $command = new ListRecordings(5);
        $command->setClient($this->client);

        $this->expectException(NoAccessException::class);

        $command->execute();
    }

    public function testInvalidDependency()
    {
        $command = new ListRecordings(5);

        $this->expectException(\BadMethodCallException::class);

        $command->execute();
    }
}
