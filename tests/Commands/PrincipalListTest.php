<?php

namespace AdobeConnectClient\Tests\Commands;

use AdobeConnectClient\Commands\PrincipalList;
use AdobeConnectClient\Entities\Principal;
use AdobeConnectClient\Exceptions\NoAccessException;
use AdobeConnectClient\Filter;
use AdobeConnectClient\Sorter;

class PrincipalListTest extends TestCommandBase
{
    public function testNoAccess()
    {
        $this->userLogout();

        $command = new PrincipalList();
        $command->setClient($this->client);

        $this->expectException(NoAccessException::class);

        $command->execute();
    }

    public function testListAll()
    {
        $this->userLogin();

        $command = new PrincipalList();
        $command->setClient($this->client);

        $principals = $command->execute();

        $this->assertEquals(2, \count($principals));

        $principal1 = $principals[0];
        $principal2 = $principals[1];

        $this->assertInstanceOf(Principal::class, $principal1);
        $this->assertInstanceOf(Principal::class, $principal2);

        $this->assertEquals(624526, $principal1->getPrincipalId());
        $this->assertEquals(624550, $principal2->getPrincipalId());
    }

    public function testListSorter()
    {
        $this->userLogin();

        $command = new PrincipalList(0, null, Sorter::instance()->asc('firstName'));
        $command->setClient($this->client);

        $principals = $command->execute();

        $this->assertEquals(2, \count($principals));

        $principal = $principals[0];
        $this->assertEquals(624550, $principal->getPrincipalId());
    }

    public function testListFilter()
    {
        $this->userLogin();

        $command = new PrincipalList(0, Filter::instance()->equals('firstName', 'amelie'));
        $command->setClient($this->client);

        $principals = $command->execute();

        $this->assertEquals(1, \count($principals));

        $principal = $principals[0];
        $this->assertEquals(624550, $principal->getPrincipalId());
    }

    public function testListEmpty()
    {
        $this->userLogin();

        $command = new PrincipalList(0, Filter::instance()->equals('firstName', 'joseph'));
        $command->setClient($this->client);

        $principals = $command->execute();

        $this->assertEmpty($principals);
    }

    public function testListGroup()
    {
        $this->userLogin();

        $command = new PrincipalList(5);
        $command->setClient($this->client);

        $principals = $command->execute();

        $this->assertEquals(1, \count($principals));

        $this->assertEquals(624526, $principals[0]->getPrincipalId());
    }
}