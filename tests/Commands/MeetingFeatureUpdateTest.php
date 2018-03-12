<?php

namespace AdobeConnectClient\Tests\Commands;

use AdobeConnectClient\Commands\MeetingFeatureUpdate;
use AdobeConnectClient\Exceptions\NoAccessException;
use AdobeConnectClient\Exceptions\InvalidException;

class MeetingFeatureUpdateTest extends TestCommandBase
{
    public function testMeetignFeatureUpdate()
    {
        $this->userLogin();

        $command = new MeetingFeatureUpdate(1, 'feature', true);
        $command->setClient($this->client);

        $this->assertTrue($command->execute());
    }

    public function testNoAccess()
    {
        $this->userLogout();

        $command = new MeetingFeatureUpdate(1, 'feature', true);
        $command->setClient($this->client);

        $this->expectException(NoAccessException::class);

        $command->execute();
    }

    public function testInvalidFeature()
    {
        $this->userLogin();


        $command = new MeetingFeatureUpdate(1, 'invalid-feature', true);
        $command->setClient($this->client);

        $this->expectException(InvalidException::class);

        $command->execute();
    }

    public function testInvalidDependency()
    {
        $command = new MeetingFeatureUpdate(1, 'invalid-feature', true);

        $this->expectException(\BadMethodCallException::class);

        $command->execute();
    }
}
