<?php

namespace AdobeConnectClient\Commands;

use AdobeConnectClient\CommandAbstract;
use AdobeConnectClient\Client;
use AdobeConnectClient\Converter\Converter;
use AdobeConnectClient\Helper\StatusValidate;

/**
 * Description of Login
 *
 * @author bruno
 */
class Login extends CommandAbstract
{
    protected $parameters;

    /**
     *
     * @param Client $client
     * @param string $login
     * @param string $password
     */
    public function __construct(Client $client, $login, $password)
    {
        parent::__construct($client);
        $this->parameters = [
            'login' => $login,
            'password' => $password
        ];
    }

    public function execute()
    {
        $response = $this->client->getConnection()->get(['action' => 'login'] + $this->parameters);
        $responseConverted = Converter::convert($response);
        StatusValidate::validate($responseConverted['status']);
        $this->client->setSession($response->getHeader('Set-Cookie'));
        return true;
    }

}
