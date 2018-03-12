<?php

namespace AdobeConnectClient\Tests\Commands;

use AdobeConnectClient\Commands\ScoUpload;
use AdobeConnectClient\Exceptions\NoAccessException;

class ScoUploadTest extends TestCommandBase
{
    public function testInvalidArgument()
    {
        $this->expectException(\InvalidArgumentException::class);

        new ScoUpload(10, 'Content Name', null);
    }

    public function testNoAccess()
    {
        $this->userLogout();

        $command = new ScoUpload(
            10,
            'Content Name',
            new \SplFileInfo('./ScoUploadTest.php')
        );
        $command->setClient($this->client);

        $this->expectException(NoAccessException::class);

        $command->execute();
    }

    public function testUsingSplFileInfo()
    {
        $this->userLogin();

        $command = new ScoUpload(
            15,
            'Content Name',
            new \SplFileInfo(__FILE__)
        );
        $command->setClient($this->client);

        $scoId = $command->execute();

        $this->assertNotEmpty($scoId);
    }

    public function testUsingResource()
    {
        $this->userLogin();

        $fileResource = fopen(__FILE__, 'r');

        $command = new ScoUpload(
            15,
            'Content Name',
            $fileResource
        );
        $command->setClient($this->client);

        $scoId = $command->execute();

        fclose($fileResource);

        $this->assertNotEmpty($scoId);
    }

    public function testUpdate()
    {
        $this->userLogin();

        $fileResource = fopen(__FILE__, 'r');

        $command = new ScoUpload(
            10,
            'Content Name',
            $fileResource
        );
        $command->setClient($this->client);

        $scoId = $command->execute();

        $this->assertNotEmpty($scoId);
    }
}
