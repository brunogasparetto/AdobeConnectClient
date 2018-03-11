<?php
/**
 * Created by PhpStorm.
 * User: Bruno
 * Date: 04/03/2018
 * Time: 20:29
 */

namespace AdobeConnectClient\Tests\Commands;

use AdobeConnectClient\Commands\PermissionUpdate;
use AdobeConnectClient\Entities\Permission;
use AdobeConnectClient\Exceptions\NoAccessException;

class PermissionUpdateTest extends TestCommandBase
{
    public function testPermissionUpdate()
    {
        $this->userLogin();

        $permission = Permission::instance()
            ->setAclId(1)
            ->setPrincipalId(1)
            ->setPermissionId(Permission::PRINCIPAL_HOST);

        $command = new PermissionUpdate($permission);
        $command->setClient($this->client);

        $this->assertTrue($command->execute());
    }

    public function testNoAccess()
    {
        $this->userLogout();

        $permission = Permission::instance()
            ->setAclId(1)
            ->setPrincipalId(1)
            ->setPermissionId(Permission::PRINCIPAL_HOST);

        $command = new PermissionUpdate($permission);
        $command->setClient($this->client);

        $this->expectException(NoAccessException::class);

        $command->execute();
    }
}
