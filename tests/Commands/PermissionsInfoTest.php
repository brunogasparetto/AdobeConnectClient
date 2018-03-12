<?php

namespace AdobeConnectClient\Tests\Commands;

use AdobeConnectClient\Commands\PermissionsInfo;
use AdobeConnectClient\Entities\Permission;
use AdobeConnectClient\Entities\Principal;
use AdobeConnectClient\Filter;
use AdobeConnectClient\Sorter;
use AdobeConnectClient\Exceptions\NoAccessException;

class PermissionsInfoTest extends TestCommandBase
{
    public function testOnlyAclId()
    {
        $this->userLogin();

        $command = new PermissionsInfo(12345);
        $command->setClient($this->client);

        $principals = $command->execute();

        $this->assertNotEmpty($principals);

        $principal = reset($principals);

        $this->assertInstanceOf(Principal::class, $principal);
        $this->assertEquals(2006258745, $principal->getPrincipalId());
        $this->assertEquals('Joy', $principal->getFirstName());
        $this->assertEquals('Smith', $principal->getLastName());
        $this->assertEquals(Permission::PRINCIPAL_HOST, $principal->getPermissionId());
    }

    public function testFilter()
    {
        $this->userLogin();

        $command = new PermissionsInfo(
            12345,
            Filter::instance()->equals('PermissionId', Permission::PRINCIPAL_MINI_HOST)
        );
        $command->setClient($this->client);

        $principals = $command->execute();

        $this->assertNotEmpty($principals);

        $principal = reset($principals);

        $this->assertInstanceOf(Principal::class, $principal);
        $this->assertEquals(5, $principal->getPrincipalId());
        $this->assertEquals('Test', $principal->getFirstName());
        $this->assertEquals('', $principal->getLastName());
        $this->assertEquals(Permission::PRINCIPAL_MINI_HOST, $principal->getPermissionId());
    }

    public function testSort()
    {
        $this->userLogin();

        $command = new PermissionsInfo(
            12345,
            null,
            Sorter::instance()->asc('permissionId')
        );
        $command->setClient($this->client);

        $principals = $command->execute();

        $this->assertNotEmpty($principals);

        $principal = reset($principals);

        $this->assertInstanceOf(Principal::class, $principal);
        $this->assertEquals(2006258745, $principal->getPrincipalId());
        $this->assertEquals('Joy', $principal->getFirstName());
        $this->assertEquals('Smith', $principal->getLastName());
        $this->assertEquals(Permission::PRINCIPAL_HOST, $principal->getPermissionId());
    }

    public function testEmpty()
    {
        $this->userLogin();

        $command = new PermissionsInfo(
            12345,
            Filter::instance()->equals('permissionId', Permission::PRINCIPAL_DENIED)
        );
        $command->setClient($this->client);

        $principals = $command->execute();

        $this->assertEmpty($principals);
    }

    public function testNoAccess()
    {
        $this->userLogout();

        $command = new PermissionsInfo(12345);
        $command->setClient($this->client);

        $this->expectException(NoAccessException::class);

        $command->execute();
    }

    public function testInvalidDependency()
    {
        $command = new PermissionsInfo(12345);

        $this->expectException(\BadMethodCallException::class);

        $command->execute();
    }
}
