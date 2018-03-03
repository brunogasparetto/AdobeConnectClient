<?php

namespace AdobeConnectClient\Tests\Commands;

use Exception;
use AdobeConnectClient\Commands\MeetingFeatureUpdate;

class MeetingFeatureUpdateTest extends TestCommandBase
{
    /**
     * return string
     */
    public function testExecute()
    {
        $command = new MeetingFeatureUpdate(1, 'feature', true);
        $command->setClient($this->client);

        $this->assertTrue($command->execute());

        return $this->client->getSession();
    }

    public function testException()
    {
        $this->expectException(Exception::class);

        $this->connection->overrideStatusWithNoAccess();

        $command = new MeetingFeatureUpdate(1, 'feature', true);
        $command->setClient($this->client);
        $command->execute();
    }
}
