<?php

namespace AdobeConnectClient\Commands;

use AdobeConnectClient\Command;
use AdobeConnectClient\Converter\Converter;
use AdobeConnectClient\Exceptions\NoDataException;
use AdobeConnectClient\Helpers\StatusValidate;
use AdobeConnectClient\Helpers\HeaderParse;

/**
 * Call the Login action and save the session cookie.
 *
 * More info see {@link https://helpx.adobe.com/content/help/en/adobe-connect/webservices/login.html}
 */
class Login extends Command
{
    /**
     * @var array
     */
    protected $parameters;

    /**
     * @param string $login
     * @param string $password
     */
    public function __construct($login, $password)
    {
        $this->parameters = [
            'action' => 'login',
            'login' => (string) $login,
            'password' => (string) $password
        ];
    }

    /**
     * @inheritdoc
     *
     * @return bool
     */
    protected function process()
    {
        $response = $this->client->doGet($this->parameters);
        $responseConverted = Converter::convert($response);

        try {
            StatusValidate::validate($responseConverted['status']);
        } catch (NoDataException $e) { // Invalid Login
            $this->client->setSession('');
            return false;
        }
        $cookieHeader = HeaderParse::parse($response->getHeader('Set-Cookie'));
        $this->client->setSession($cookieHeader[0]['BREEZESESSION']);
        return true;
    }
}
