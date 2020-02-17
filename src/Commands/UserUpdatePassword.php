<?php
declare(strict_types=1);

namespace AdobeConnectClient\Commands;

use AdobeConnectClient\Command;
use AdobeConnectClient\Converter\Converter;
use AdobeConnectClient\Helpers\StatusValidate;

/**
 * Changes user’s password.
 *
 * More info see {@link https://helpx.adobe.com/adobe-connect/webservices/user-update-pwd.html}
 */
class UserUpdatePassword extends Command
{
    /**
     * @var array
     */
    protected $parameters;

    /**
     * @param int $userId The Principal Id for user
     * @param string $newPassword
     * @param string $oldPassword
     */
    public function __construct(int $userId, string $newPassword, string $oldPassword = '')
    {
        $this->parameters = [
            'action' => 'user-update-pwd',
            'password' => $newPassword,
            'user-id' => $userId,
            'password-verify' => $newPassword,
        ];

        if (!empty($oldPassword)) {
            $this->parameters['password-old'] = $oldPassword;
        }
    }

    /**
     * @inheritdoc
     *
     * @return bool
     */
    protected function process(): bool
    {
        $response = Converter::convert(
            $this->client->doGet(
                $this->parameters + ['session' => $this->client->getSession()]
            )
        );
        StatusValidate::validate($response['status']);
        return true;
    }
}
