<?php

namespace AdobeConnectClient\Entities;

use AdobeConnectClient\Helpers\ValueTransform as VT;

/**
 * Result for Common Info Action
 */
class CommonInfo
{
    /**
     *  @var string
     */
    protected $locale = null;

    /**
     * Time Zone ID list in
     * {@link https://helpx.adobe.com/adobe-connect/webservices/common-xml-elements-attributes.html#time_zone_id}
     *
     * @var int
     */
    protected $timeZoneId = null;

    /**
     *  @var string
     */
    protected $cookie = null;

    /**
     * @var \DateTimeImmutable
     */
    protected $date = null;

    /**
     *  @var string
     */
    protected $host = null;

    /**
     *  @var string
     */
    protected $localHost = null;

    /**
     *  @var string
     */
    protected $adminHost = null;

    /**
     *  @var string
     */
    protected $url = null;

    /**
     *  @var string
     */
    protected $version = null;

    /**
     * @var int
     */
    protected $accountId = null;

    /**
     * Get the Locale
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Get the Timezone ID
     *
     * @return int
     */
    public function getTimeZoneId()
    {
        return $this->timeZoneId;
    }

    /**
     * Get the Cookie
     *
     * @return string
     */
    public function getCookie()
    {
        return $this->cookie;
    }

    /**
     * Get the Date
     *
     * @return \DateTimeImmutable
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Get the Host
     *
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * Get the Local Host
     *
     * @return string
     */
    public function getLocalHost()
    {
        return $this->localHost;
    }

    /**
     * Get the Admin Host
     *
     * @return string
     */
    public function getAdminHost()
    {
        return $this->adminHost;
    }

    /**
     * Get the URL
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Get the Version
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Get the Account ID
     *
     * @return int
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * Set the Locale
     *
     * @param string $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }

    /**
     * Set the Timezone ID
     *
     * @param int $timeZoneId
     */
    public function setTimeZoneId($timeZoneId)
    {
        $this->timeZoneId = (int) $timeZoneId;
    }

    /**
     * Set the Cookie
     *
     * @param string $cookie
     */
    public function setCookie($cookie)
    {
        $this->cookie = $cookie;
    }

    /**
     * Set the Date
     *
     * @param \DateTimeInterface|string $date
     */
    public function setDate($date)
    {
        $this->date = VT::toDateTimeImmutable($date);
    }

    /**
     * Set the Host
     *
     * @param string $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * Set the Local Host
     *
     * @param string $localHost
     */
    public function setLocalHost($localHost)
    {
        $this->localHost = $localHost;
    }

    /**
     * Set the Admin Host
     *
     * @param string $adminHost
     */
    public function setAdminHost($adminHost)
    {
        $this->adminHost = $adminHost;
    }

    /**
     * Set the URL
     *
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Set the Version
     *
     * @param string $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    /**
     * Set the Account ID
     *
     * @param int $accountId
     */
    public function setAccountId($accountId)
    {
        $this->accountId = (int) $accountId;
    }
}
