<?php
/**
 * Created by PhpStorm.
 * User: Bruno
 * Date: 05/03/2018
 * Time: 22:20
 */

namespace AdobeConnectClient\Tests\Commands;

use AdobeConnectClient\Commands\PrincipalInfo;
use AdobeConnectClient\Entities\Principal;
use AdobeConnectClient\Exceptions\NoAccessException;

class PrincipalInfoTest extends TestCommandBase
{
    public function testPrincipalInfo()
    {
        $this->userLogin();

        $command = new PrincipalInfo(2006258745);
        $command->setClient($this->client);

        $principal = $command->execute();

        $this->assertInstanceOf(Principal::class, $principal);
        $this->assertEquals(2006258745, $principal->getPrincipalId());
        $this->assertEquals('Smith', $principal->getLastName());
    }

    public function testNoAccess()
    {
        $this->userLogout();

        $command = new PrincipalInfo(2006258745);
        $command->setClient($this->client);

        $this->expectException(NoAccessException::class);

        $command->execute();
    }
}
