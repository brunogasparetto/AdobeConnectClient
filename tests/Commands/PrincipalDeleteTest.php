<?php
/**
 * Created by PhpStorm.
 * User: Bruno
 * Date: 05/03/2018
 * Time: 21:52
 */

namespace AdobeConnectClient\Tests\Commands;

use AdobeConnectClient\Commands\PrincipalDelete;
use AdobeConnectClient\Exceptions\NoAccessException;

class PrincipalDeleteTest extends TestCommandBase
{
    public function testDeletePrincipal()
    {
        $this->userLogin();

        $command = new PrincipalDelete(1);
        $command->setClient($this->client);

        $this->assertTrue($command->execute());
    }

    public function testNoAccess()
    {
        $this->userLogout();

        $command = new PrincipalDelete(1);
        $command->setClient($this->client);

        $this->expectException(NoAccessException::class);

        $command->execute();
    }
}
