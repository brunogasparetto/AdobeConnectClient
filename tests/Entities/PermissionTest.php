<?php

namespace AdobeConnectClient\Tests;

use AdobeConnectClient\Entities\Permission;
use AdobeConnectClient\ArrayableInterface;
use PHPUnit\Framework\TestCase;

class PermissionTest extends TestCase
{

    public function testInstance()
    {
        $this->assertInstanceOf(Permission::class, Permission::instance());
    }

    public function testIsArrayable()
    {
        $this->assertInstanceOf(ArrayableInterface::class, Permission::instance());
    }

    public function testAclId()
    {
        $permission = Permission::instance();

        $permission->setAclId(1);
        $this->assertEquals(1, $permission->getAclId());

        $permission->setAclId('1');
        $this->assertEquals(1, $permission->getAclId());
    }

    public function testPermissionId()
    {
        $permission = Permission::instance();

        $permission->setPermissionId(Permission::MEETING_ANYONE_WITH_URL);
        $this->assertEquals(Permission::MEETING_ANYONE_WITH_URL, $permission->getPermissionId());
    }

    public function testPrincipalId()
    {
        $permission = Permission::instance();

        $permission->setPrincipalId(Permission::PRINCIPAL_HOST);
        $this->assertEquals(Permission::PRINCIPAL_HOST, $permission->getPrincipalId());

        $permission->setPrincipalId(1);
        $this->assertEquals(1, $permission->getPrincipalId());
    }

    public function testToArray()
    {
        $permission = Permission::instance()
            ->setAclId(1)
            ->setPermissionId(Permission::MEETING_ANYONE_WITH_URL)
            ->setPrincipalId(Permission::MEETING_PRINCIPAL_PUBLIC_ACCESS);

        $this->assertEquals(
            [
                'acl-id' => 1,
                'permission-id' => Permission::MEETING_ANYONE_WITH_URL,
                'principal-id' => Permission::MEETING_PRINCIPAL_PUBLIC_ACCESS
            ],
            $permission->toArray()
        );
    }
}