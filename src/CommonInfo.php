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
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     *
     * @return int
     */
    public function getTimeZoneId()
    {
        return $this->timeZoneId;
    }

    /**
     *
     * @return string
     */
    public function getCookie()
    {
        return $this->cookie;
    }

    /**
     *
     * @return \DateTimeImmutable
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     *
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     *
     * @return string
     */
    public function getLocalHost()
    {
        return $this->localHost;
    }

    /**
     *
     * @return string
     */
    public function getAdminHost()
    {
        return $this->adminHost;
    }

    /**
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     *
     * @return int
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     *
     * @param string $locale
     * @return $this Fluent Interface
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
        return $this;
    }

    /**
     *
     * @param int $timeZoneId
     * @return $this Fluent Interface
     */
    public function setTimeZoneId($timeZoneId)
    {
        $this->timeZoneId = $timeZoneId;
        return $this;
    }

    /**
     *
     * @param string $cookie
     * @return $this Fluent Interface
     */
    public function setCookie($cookie)
    {
        $this->cookie = $cookie;
        return $this;
    }

    /**
     *
     * @param \DateTimeImmutable $date
     * @return $this Fluent Interface
     */
    public function setDate($date)
    {
        $this->date = $date instanceof \DateTime ? $date : new \DateTimeImmutable($date);
        return $this;
    }

    /**
     *
     * @param string $host
     * @return $this Fluent Interface
     */
    public function setHost($host)
    {
        $this->host = $host;
        return $this;
    }

    /**
     *
     * @param string $localHost
     * @return $this Fluent Interface
     */
    public function setLocalHost($localHost)
    {
        $this->localHost = $localHost;
        return $this;
    }

    /**
     *
     * @param string $adminHost
     * @return $this Fluent Interface
     */
    public function setAdminHost($adminHost)
    {
        $this->adminHost = $adminHost;
        return $this;
    }

    /**
     *
     * @param string $url
     * @return $this Fluent Interface
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     *
     * @param string $version
     * @return $this Fluent Interface
     */
    public function setVersion($version)
    {
        $this->version = $version;
        return $this;
    }

    /**
     *
     * @param int $accountId
     * @return $this Fluent Interface
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;
        return $this;
    }
}
