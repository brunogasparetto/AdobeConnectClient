<?php

namespace Bruno\AdobeConnectClient\Type;

/**
 * Adobe Connect's types constants to Custom Field
 *
 * @link https://helpx.adobe.com/adobe-connect/webservices/common-xml-elements-attributes.html#type
 *
 */
abstract class CustomField
{
    /**
     * A required custom field for the account.
     */
    const REQUIRED = 'required';

    /**
     * An optional field that is displayed during self-registration.
     */
    const OPTIONAL = 'optional';

    /**
     * An optional field that is hidden during self-registration.
     */
    const OPTIONAL_NO_SELF_REG = 'optional-no-self-reg';
}
