<?php

namespace AdobeConnectClient\Tests\Commands;

use Exception;
use AdobeConnectClient\Commands\ListRecordings;
use AdobeConnectClient\Entities\SCORecord;
use AdobeConnectClient\Helpers\SetEntityAttributes;

class ListRecordingsTest extends TestCommandBase
{
    public function testExecute()
    {
        $command = new ListRecordings(1);
        $command->setClient($this->client);

        /**
         * @var SCORecord[]
         */
        $records = $command->execute();

        $phpArrayResource = $this->connection->getLasActionArrayResource();

        $expected = new SCORecord();
        SetEntityAttributes::setAttributes($expected, $phpArrayResource['recordings'][0]);
        $this->assertEquals($expected, $records[0]);
    }

    public function testException()
    {
        $this->expectException(Exception::class);

        $this->connection->overrideStatusWithNoData();

        $command = new ListRecordings(1);
        $command->setClient($this->client);
        $command->execute();
    }
}
