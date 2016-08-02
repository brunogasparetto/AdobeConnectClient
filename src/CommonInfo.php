<?php

namespace Bruno\AdobeConnectClient;

/**
 * Result for Common Info Action
 */
class CommonInfo
{
    /**
     * @var string
     */
    public $locale = '';

    /**
     * Time Zone ID list in {@link https://helpx.adobe.com/adobe-connect/webservices/common-xml-elements-attributes.html#time_zone_id}
     *
     * @var int
     */
    public $timeZoneId = -1;

    /**
     * @var
     */
    public $cookie = '';

    /**
     * @var \DateTimeImmutable
     */
    public $date = null;

    /**
     * @var string
     */
    public $host = '';

    /**
     * @var string
     */
    public $localHost = '';

    /**
     * @var string
     */
    public $adminHost = '';

    /**
     * @var string
     */
    public $url = '';

    /**
     * @var string
     */
    public $version = '';

    /**
     * @var int
     */
    public $accountId = 0;

    public function __construct(\SimpleXMLElement $xmlElement = null)
    {
        if (!$xmlElement) {
            return;
        }

        $commonAttributes = $xmlElement->attributes();
        $this->locale = (string) $commonAttributes->{'locale'};
        $this->timeZoneId = (int) (string) $commonAttributes->{'time-zone-id'};
        unset($commonAttributes);

        $this->cookie = (string) $xmlElement->{'cookie'};
        $this->host = (string) $xmlElement->{'host'};
        $this->localHost = (string) $xmlElement->{'local-host'};
        $this->adminHost = (string) $xmlElement->{'admin-host'};
        $this->url = (string) $xmlElement->{'url'};
        $this->version = (string) $xmlElement->{'version'};
        $this->date = new \DateTimeImmutable((string) $xmlElement->{'date'});

        $accountAttributes = $xmlElement->account->attributes();
        $this->accountId = (int) $accountAttributes->{'account-id'};
        unset($accountAttributes);
    }
}
