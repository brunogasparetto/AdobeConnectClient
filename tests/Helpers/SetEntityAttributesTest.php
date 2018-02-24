<?php

use \PHPUnit\Framework\TestCase;
use \AdobeConnectClient\Helpers\SetEntityAttributes;
use \AdobeConnectClient\Entities\Permission;

class SetEntityAttributesTest extends TestCase
{

    public function testSetAttributes()
    {
        $data = [
            'acl-id' => 5,
            'permission-id' => Permission::PRINCIPAL_HOST,
            'imaginary' => [
                'principal-id' => 10
            ]
        ];

        $permission = new Permission();

        SetEntityAttributes::setAttributes($permission, $data);

        $this->assertEquals($data['acl-id'], $permission->getAclId());
        $this->assertEquals($data['permission-id'], $permission->getPermissionId());
        $this->assertEquals($data['imaginary']['principal-id'], $permission->getPrincipalId());
    }
}