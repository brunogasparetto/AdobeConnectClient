<?php

namespace AdobeConnectClient\Tests\Commands;

use AdobeConnectClient\Commands\PrincipalUpdate;
use AdobeConnectClient\Entities\Principal;
use AdobeConnectClient\Exceptions\NoAccessException;

class PrincipalUpdateTest extends TestCommandBase
{
    /**
     * Create a new Principal User
     *
     * @return Principal
     */
    private function createPrincipalUser()
    {
        return Principal::instance()
            ->setType(Principal::TYPE_USER)
            ->setPrincipalId(2006403978)
            ->setFirstName('john')
            ->setLastName('doe')
            ->setHasChildren(false)
            ->setLogin('johndoe@example.com')
            ->setEmail('johndoe@example.com');
    }

    /**
     * Create a new Principal Group
     *
     * @return Principal
     */
    private function createPrincipalGroup()
    {
        return Principal::instance()
            ->setType(Principal::TYPE_GROUP)
            ->setPrincipalId(2006403979)
            ->setHasChildren(true)
            ->setName('New Group Test Name')
            ->setDescription('New Group Test Description');
    }

    public function testNoAccess()
    {
        $this->userLogout();

        $principal = $this->createPrincipalUser();

        $command = new PrincipalUpdate($principal);
        $command->setClient($this->client);

        $this->expectException(NoAccessException::class);

        $command->execute();
    }

    public function testUpdateUser()
    {
        $this->userLogin();

        $principal = $this->createPrincipalUser();

        $command = new PrincipalUpdate($principal);
        $command->setClient($this->client);

        $this->assertTrue($command->execute());

    }

    public function testUpdateGroup()
    {
        $this->userLogin();

        $principal = $this->createPrincipalGroup();

        $command = new PrincipalUpdate($principal);
        $command->setClient($this->client);

        $this->assertTrue($command->execute());
    }
}
