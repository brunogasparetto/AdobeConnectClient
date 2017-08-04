<?php

namespace AdobeConnectClient\Commands;

use AdobeConnectClient\Commands\CommandAbstract;

/**
 * Ends the session
 *
 * @see https://helpx.adobe.com/content/help/en/adobe-connect/webservices/logout.html
 */
class Logout extends CommandAbstract
{
    public function execute()
    {
        $this->client->getConnection()->get([
            'action' => 'logout',
            'session' => $this->client->getSession()
        ]);
        $this->client->setSession('');
        return true;
    }
}
