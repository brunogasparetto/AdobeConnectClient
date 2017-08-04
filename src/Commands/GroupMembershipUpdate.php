<?php

namespace AdobeConnectClient\Commands;

use AdobeConnectClient\CommandAbstract;
use AdobeConnectClient\Client;
use AdobeConnectClient\Converter\Converter;
use AdobeConnectClient\Helpers\StatusValidate;
use AdobeConnectClient\Helpers\BooleanTransform as BT;

/**
 * Adds one principal to a group, or removes one principal from a group.
 *
 * @see https://helpx.adobe.com/adobe-connect/webservices/group-membership-update.html
 */
class GroupMembershipUpdate extends CommandAbstract
{
    /** @var array */
    protected $parameters;

    /**
     * @param Client $client
     * @param int $groupId
     * @param int $principalId
     * @param bool $isMember
     */
    public function __construct(Client $client, $groupId, $principalId, $isMember)
    {
        parent::__construct($client);

        $this->parameters = [
            'action' => 'group-membership-update',
            'group-id' => (int) $groupId,
            'principal-id' => (int) $principalId,
            'is-member' => BT::toBoolean($isMember),
            'session' => $client->getSession()
        ];
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
