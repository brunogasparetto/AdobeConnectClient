<?php

namespace AdobeConnectClient\Commands;

use AdobeConnectClient\Commands\CommandAbstract;
use AdobeConnectClient\Client;
use AdobeConnectClient\ParameterInterface;
use AdobeConnectClient\Converter\Converter;
use AdobeConnectClient\Helpers\StatusValidate;
use AdobeConnectClient\Helpers\StringCaseTransform as SCT;
use AdobeConnectClient\Helpers\ValueTransform as VT;

/**
 * Updates the passed in field-id for the specified SCO, Principal or Account.
 *
 * @see https://helpx.adobe.com/adobe-connect/webservices/acl-field-update.html
 */
class AclFieldUpdate extends CommandAbstract
{
    /** @var array */
    protected $parameters;

    /**
     *
     * @param Client $client
     * @param int $aclId
     * @param string $fieldId
     * @param mixed $value
     * @param ParameterInterface $extraParams
     */
    public function __construct(Client $client, $aclId, $fieldId, $value, ParameterInterface $extraParams = null)
    {
        parent::__construct($client);

        $this->parameters = [
            'action' => 'acl-field-update',
            'acl-id' => $aclId,
            'field-id' => SCT::toHyphen($fieldId),
            'value' => VT::toString($value),
            'session' => $client->getSession()
        ];

        if ($extraParams) {
            $this->parameters += $extraParams->toArray();
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
