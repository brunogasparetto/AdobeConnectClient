<?php

namespace AdobeConnectClient\Commands;

use AdobeConnectClient\CommandAbstract;
use AdobeConnectClient\Client;
use AdobeConnectClient\Converter\Converter;
use AdobeConnectClient\Helpers\StatusValidate;

/**
 * Changes user’s password.
 *
 * @see https://helpx.adobe.com/adobe-connect/webservices/user-update-pwd.html
 */
class UserUpdatePassword extends CommandAbstract
{
    /** @var array */
    protected $parameters;

    /**
     * @param Client $client
     * @param int $userId The Principal Id for user
     * @param string $newPassword
     * @param string $oldPassword
     */
    public function __construct(Client $client, $userId, $newPassword, $oldPassword = '')
    {
        parent::__construct($client);

        $this->parameters = [
            'action' => 'user-update-pwd',
            'password' => $newPassword,
            'user-id' => (int) $userId,
            'password-verify' => $newPassword,
            'section' => $client->getSession()
        ];

        if (!empty($oldPassword)) {
            $this->parameters['password-old'] = $oldPassword;
        }
    }

    /**
     * @return bool
     */
    public function execute()
    {
        $responseConverted = Converter::convert(
            $this->client->getConnection()->get($this->parameters)
        );
        StatusValidate::validate($responseConverted['status']);
        return true;
    }
}
