<?php

namespace AdobeConnectClient\Commands;

use AdobeConnectClient\Command;

/**
 * Ends the session
 *
 * @link https://helpx.adobe.com/content/help/en/adobe-connect/webservices/logout.html
 */
class Logout extends Command
{
    protected function process()
    {
        $this->client->getConnection()->get([
            'action' => 'logout',
            'session' => $this->client->getSession()
        ]);
        $this->client->setSession('');
        return true;
    }
}
