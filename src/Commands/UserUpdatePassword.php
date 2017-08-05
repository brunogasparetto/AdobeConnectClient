<?php

namespace AdobeConnectClient\Commands;

use AdobeConnectClient\Command;
use AdobeConnectClient\Client;
use AdobeConnectClient\Converter\Converter;
use AdobeConnectClient\Helpers\StatusValidate;

/**
 * Changes user’s password.
 *
 * @link https://helpx.adobe.com/adobe-connect/webservices/user-update-pwd.html
 */
class UserUpdatePassword extends Command
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
            'session' => $client->getSession()
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
