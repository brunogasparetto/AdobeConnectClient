<?php

namespace AdobeConnectClient\Tests\Commands;

use Exception;
use AdobeConnectClient\Commands\GroupMembershipUpdate;

class GroupMembershipUpdateTest extends TestCommandBase
{
    public function testExecute()
    {

        $command = new GroupMembershipUpdate(1, 1, true);
        $command->setClient($this->client);

        $this->assertTrue($command->execute());
    }

    public function testException()
    {
        $this->expectException(Exception::class);

        $this->connection->overrideStatusWithNoAccess();

        $command = new GroupMembershipUpdate(1, 1, true);
        $command->setClient($this->client);
        $command->execute();
    }
}
