<?php

namespace AdobeConnectClient;

/**
 * Result for Common Info Action
 */
class CommonInfo implements EntityInterface
{
    use Traits\EntityTrait;

    /** @var string */
    protected $locale = null;

    /**
     * Time Zone ID list in
     * {@link https://helpx.adobe.com/adobe-connect/webservices/common-xml-elements-attributes.html#time_zone_id}
     *
     * @var int
     */
    protected $timeZoneId = null;

    /** @var string */
    protected $cookie = null;

    /** @var \DateTimeImmutable */
    protected $date = null;

    /** @var string */
    protected $host = null;

    /** @var string */
    protected $localHost = null;

    /** @var string */
    protected $adminHost = null;

    /** @var string */
    protected $url = null;

    /** @var string */
    protected $version = null;

    /** @var int */
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
     * @return CommonInfo Fluent Interface
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
        return $this;
    }

    /**
     * Set the Timezone ID
     *
     * @param int $timeZoneId
     * @return CommonInfo Fluent Interface
     */
    public function setTimeZoneId($timeZoneId)
    {
        $this->timeZoneId = $timeZoneId;
        return $this;
    }

    /**
     * Set the Cookie
     *
     * @param string $cookie
     * @return CommonInfo Fluent Interface
     */
    public function setCookie($cookie)
    {
        $this->cookie = $cookie;
        return $this;
    }

    /**
     * Set the Date
     *
     * @param \DateTimeImmutable|string $date
     * @return CommonInfo Fluent Interface
     */
    public function setDate($date)
    {
        $this->date = $date instanceof \DateTime ? $date : new \DateTimeImmutable($date);
        return $this;
    }

    /**
     * Set the Host
     *
     * @param string $host
     * @return CommonInfo Fluent Interface
     */
    public function setHost($host)
    {
        $this->host = $host;
        return $this;
    }

    /**
     * Set the Local Host
     *
     * @param string $localHost
     * @return CommonInfo Fluent Interface
     */
    public function setLocalHost($localHost)
    {
        $this->localHost = $localHost;
        return $this;
    }

    /**
     * Set the Admin Host
     *
     * @param string $adminHost
     * @return CommonInfo Fluent Interface
     */
    public function setAdminHost($adminHost)
    {
        $this->adminHost = $adminHost;
        return $this;
    }

    /**
     * Set the URL
     *
     * @param string $url
     * @return CommonInfo Fluent Interface
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Set the Version
     *
     * @param string $version
     * @return CommonInfo Fluent Interface
     */
    public function setVersion($version)
    {
        $this->version = $version;
        return $this;
    }

    /**
     * Set the Account ID
     *
     * @param int $accountId
     * @return CommonInfo Fluent Interface
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;
        return $this;
    }
}
