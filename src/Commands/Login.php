<?php

namespace AdobeConnectClient\Commands;

use AdobeConnectClient\CommandAbstract;
use AdobeConnectClient\Client;
use AdobeConnectClient\Converter\Converter;
use AdobeConnectClient\Exceptions\NoDataException;
use AdobeConnectClient\Helpers\StatusValidate;
use AdobeConnectClient\Helpers\HeaderParse;

/**
 * Call the Login action and save the session cookie.
 *
 * @see https://helpx.adobe.com/content/help/en/adobe-connect/webservices/login.html
 */
class Login extends CommandAbstract
{
    /** @var array Associative array */
    protected $parameters;

    /**
     * @param Client $client
     * @param string $login
     * @param string $password
     */
    public function __construct(Client $client, $login, $password)
    {
        parent::__construct($client);
        $this->parameters = [
            'action' => 'login',
            'login' => (string) $login,
            'password' => (string) $password
        ];
    }

    public function execute()
    {
        $response = $this->client->getConnection()->get($this->parameters);
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
