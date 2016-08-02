<?php

namespace Bruno\AdobeConnectClient;

use \Bruno\AdobeConnectClient\Helper\BooleanStr as B;

/**
 * The recording archive from a SCO
 */
class SCORecord
{
    /**
     * @var int
     */
    public $scoId = 0;

    /**
     * @var int
     */
    public $sourceScoId = 0;

    /**
     * @var int
     */
    public $folderId = 0;

    /**
     * @var string
     */
    public $type = '';

    /**
     * @var string
     */
    public $icon = '';

    /**
     * @var int
     */
    public $displaySeq = 0;

    /**
     * @var int
     */
    public $jobId = 0;

    /**
     * @var int
     */
    public $accountId = 0;

    /**
     * @var string
     */
    public $jobStatus = '';

    /**
     * @var int
     */
    public $encoderServiceJobProgress = 0;

    /**
     * @var bool
     */
    public $isFolder = false;

    /**
     * @var int
     */
    public $noOfDownloads = 0;

    /**
     * @var string
     */
    public $name = '';

    /**
     * @var string
     */
    public $urlPath = '';

    /**
     * @var \DateTimeImmutable
     */
    public $dateBegin = null;

    /**
     * @var \DateTimeImmutable
     */
    public $dateEnd= null;

    /**
     * @var \DateTimeImmutable
     */
    public $dateCreated= null;

    /**
     * @var \DateTimeImmutable
     */
    public $dateModified= null;

    /**
     * @var \DateInterval
     */
    public $duration = null;

    /**
     * @var string
     */
    public $filename = '';

    public function __construct(\SimpleXMLElement $xmlElement = null)
    {
        if (!$xmlElement) {
            return;
        }
        $this->setWithAttributes($xmlElement->attributes());
        $this->name = (string) $xmlElement->{'name'};
        $this->urlPath = (string) $xmlElement->{'url-path'};
        $this->filename = (string) $xmlElement->{'filename'};
        $this->dateBegin = new \DateTimeImmutable((string) $xmlElement->{'date-begin'});
        $this->dateEnd = new \DateTimeImmutable((string) $xmlElement->{'date-end'});
        $this->dateCreated = new \DateTimeImmutable((string) $xmlElement->{'date-created'});
        $this->dateModified = new \DateTimeImmutable((string) $xmlElement->{'date-modified'});
        $this->duration = $this->convertTimeStringToDateInterval((string) $xmlElement->{'duration'});
    }

    /**
     * Converts the time duration into a \DateInterval
     *
     * @param string $timeString A string like hh:mm:ss
     * @return \DateInterval
     */
    protected function convertTimeStringToDateInterval($timeString)
    {
        return new \DateInterval(
            preg_replace(
                '/(\d{2}):(\d{2}):(\d{2}).*/',
                'PT$1H$2M$3S',
                $timeString
            )
        );
    }

    protected function setWithAttributes(\SimpleXMLElement $xmlAttributes)
    {
        $this->accountId = intval($xmlAttributes->{'account-id'});
        $this->displaySeq = (string) $xmlAttributes->{'display-seq'};
        $this->folderId = intval($xmlAttributes->{'folder-id'});
        $this->icon = (string) $xmlAttributes->{'icon'};
        $this->scoId = intval($xmlAttributes->{'sco-id'});
        $this->sourceScoId = intval($xmlAttributes->{'source-sco-id'});
        $this->type = mb_strtolower((string) $xmlAttributes->{'type'});
        $this->jobId = intval($xmlAttributes->{'job-id'});
        $this->noOfDownloads = intval($xmlAttributes->{'no-of-downloads'});
        $this->isFolder = B::toBoolean($xmlAttributes->{'is-folder'});
        $this->jobStatus = (string) $xmlAttributes->{'job-status'};
        $this->encoderServiceJobProgress = (string) $xmlAttributes->{'encoder-service-job-progress'};
    }
}
