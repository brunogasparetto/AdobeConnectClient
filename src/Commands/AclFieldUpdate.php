<?php

namespace AdobeConnectClient\Commands;

use AdobeConnectClient\Command;
use AdobeConnectClient\ArrayableInterface;
use AdobeConnectClient\Converter\Converter;
use AdobeConnectClient\Helpers\StatusValidate;
use AdobeConnectClient\Helpers\StringCaseTransform as SCT;
use AdobeConnectClient\Helpers\ValueTransform as VT;

/**
 * Updates the passed in field-id for the specified SCO, Principal or Account.
 *
 * More info see {@link https://helpx.adobe.com/adobe-connect/webservices/acl-field-update.html}
 */
class AclFieldUpdate extends Command
{
    /**
     * @var array
     */
    protected $parameters;

    /**
     *
     * @param int $aclId
     * @param string $fieldId
     * @param mixed $value
     * @param ArrayableInterface|null $extraParams
     */
    public function __construct($aclId, $fieldId, $value, ArrayableInterface $extraParams = null)
    {
        $this->parameters = [
            'action' => 'acl-field-update',
            'acl-id' => $aclId,
            'field-id' => SCT::toHyphen($fieldId),
            'value' => VT::toString($value),
        ];

        if ($extraParams) {
            $this->parameters += $extraParams->toArray();
        }
    }

    /**
     * @inheritdoc
     *
     * @return bool
     */
    protected function process()
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
