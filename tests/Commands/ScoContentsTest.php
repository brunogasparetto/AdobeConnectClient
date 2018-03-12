<?php

namespace AdobeConnectClient\Tests\Commands;

use AdobeConnectClient\Commands\ScoContents;
use AdobeConnectClient\Exceptions\NoAccessException;
use AdobeConnectClient\Filter;
use AdobeConnectClient\Sorter;

class ScoContentsTest extends TestCommandBase
{
    public function testNoAccess()
    {
        $this->userLogout();

        $command = new ScoContents(1);
        $command->setClient($this->client);

        $this->expectException(NoAccessException::class);

        $command->execute();
    }

    public function testEmpty()
    {
        $this->userLogin();

        $command = new ScoContents(1);
        $command->setClient($this->client);

        $scos = $command->execute();

        $this->assertEmpty($scos);
    }

    public function testContents()
    {
        $this->userLogin();

        $command = new ScoContents(2);
        $command->setClient($this->client);

        $scos = $command->execute();

        $this->assertEquals(2, \count($scos));

        $sco = $scos[0];

        $this->assertEquals(2007035246, $sco->getScoId());
        $this->assertEquals(2006334909, $sco->getSourceScoId());
    }

    public function testWithFilter()
    {
        $this->userLogin();

        $command = new ScoContents(2, Filter::instance()->equals('name', 'Adobe Connect 001'));
        $command->setClient($this->client);

        $scos = $command->execute();

        $this->assertEquals(1, \count($scos));

        $sco = $scos[0];

        $this->assertEquals(2007035246, $sco->getScoId());
        $this->assertEquals(2006334909, $sco->getSourceScoId());
    }

    public function testWithSorter()
    {
        $this->userLogin();

        $command = new ScoContents(2, null, Sorter::instance()->desc('name'));
        $command->setClient($this->client);

        $scos = $command->execute();

        $this->assertEquals(2, \count($scos));

        $sco = $scos[0];

        $this->assertEquals(2007035247, $sco->getScoId());
        $this->assertEquals(0, $sco->getSourceScoId());
    }
}
