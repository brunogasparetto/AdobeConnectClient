<?php

namespace AdobeConnectClient;

use DateTimeImmutable;
use DateInterval;
use AdobeConnectClient\Helpers\ValueTransform as VT;

/**
 * The recording archive from a SCO
 */
class SCORecord
{
    /**
     * @var int
     */
    protected $scoId = null;

    /**
     * @var int
     */
    protected $sourceScoId = null;

    /**
     * @var int
     */
    protected $folderId = null;

    /**
     * @var string
     */
    protected $type = null;

    /**
     * @var string
     */
    protected $icon = null;

    /**
     * @var int
     */
    protected $displaySeq = null;

    /**
     * @var int
     */
    protected $jobId = null;

    /**
     * @var int
     */
    protected $accountId = null;

    /**
     * @var string
     */
    protected $jobStatus = null;

    /**
     * @var int
     */
    protected $encoderServiceJobProgress = null;

    /**
     * @var bool
     */
    protected $isFolder = null;

    /**
     * @var int
     */
    protected $noOfDownloads = null;

    /**
     * @var string
     */
    protected $name = null;

    /**
     * @var string
     */
    protected $urlPath = null;

    /**
     * @var DateTimeImmutable
     */
    protected $dateBegin = null;

    /**
     * @var DateTimeImmutable
     */
    protected $dateEnd= null;

    /**
     * @var DateTimeImmutable
     */
    protected $dateCreated= null;

    /**
     * @var DateTimeImmutable
     */
    protected $dateModified= null;

    /**
     * @var DateInterval
     */
    protected $duration = null;

    /**
     * @var string
     */
    protected $filename = null;

    /**
     * Get the ID
     *
     * @return int
     */
    public function getScoId()
    {
        return $this->scoId;
    }

    /**
     * Get the Source ID
     *
     * @return int
     */
    public function getSourceScoId()
    {
        return $this->sourceScoId;
    }

    /**
     * Get the Folder ID
     * @return int
     */
    public function getFolderId()
    {
        return $this->folderId;
    }

    /**
     * Get the Type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get the Icon
     *
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Get the Display Sequence
     *
     * @return int
     */
    public function getDisplaySeq()
    {
        return $this->displaySeq;
    }

    /**
     * Get the Job ID
     *
     * @return int
     */
    public function getJobId()
    {
        return $this->jobId;
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
     * Get the Job Status
     *
     * @return string
     */
    public function getJobStatus()
    {
        return $this->jobStatus;
    }

    /**
     * Get the Encoder Service Progress
     *
     * @return int
     */
    public function getEncoderServiceJobProgress()
    {
        return $this->encoderServiceJobProgress;
    }

    /**
     * Indicates if is a Folder
     *
     * @return bool
     */
    public function getIsFolder()
    {
        return $this->isFolder;
    }

    /**
     * Get the Number of Downloads
     *
     * @return int
     */
    public function getNoOfDownloads()
    {
        return $this->noOfDownloads;
    }

    /**
     * Get the Name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the URL
     *
     * @return string
     */
    public function getUrlPath()
    {
        return $this->urlPath;
    }

    /**
     * Get the Begin date
     *
     * @return DateTimeImmutable
     */
    public function getDateBegin()
    {
        return $this->dateBegin;
    }

    /**
     * Get the End date
     *
     * @return DateTimeImmutable
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * Get the Created date
     *
     * @return DateTimeImmutable
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Get the Modified date
     *
     * @return DateTimeImmutable
     */
    public function getDateModified()
    {
        return $this->dateModified;
    }

    /**
     * Get the Duration
     *
     * @return DateInterval
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Get the Filename
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set the SCO ID
     *
     * @param int $scoId
     * @return SCORecord Fluent Interface
     */
    public function setScoId($scoId)
    {
        $this->scoId = (int) $scoId;
        return $this;
    }

    /**
     * Set the Source ID
     *
     * @param int $sourceScoId
     * @return SCORecord Fluent Interface
     */
    public function setSourceScoId($sourceScoId)
    {
        $this->sourceScoId = (int) $sourceScoId;
        return $this;
    }

    /**
     * Set the Folder ID
     *
     * @param int $folderId
     * @return SCORecord Fluent Interface
     */
    public function setFolderId($folderId)
    {
        $this->folderId = (int) $folderId;
        return $this;
    }

    /**
     * Set the Type
     *
     * @param string $type
     * @return SCORecord Fluent Interface
     */
    public function setType($type)
    {
        $this->type = (string) $type;
        return $this;
    }

    /**
     * Set the Icon
     *
     * @param string $icon
     * @return SCORecord Fluent Interface
     */
    public function setIcon($icon)
    {
        $this->icon = (string) $icon;
        return $this;
    }

    /**
     * Set the Display sequence
     *
     * @param int $displaySeq
     * @return SCORecord Fluent Interface
     */
    public function setDisplaySeq($displaySeq)
    {
        $this->displaySeq = (int) $displaySeq;
        return $this;
    }

    /**
     * Set the Job ID
     *
     * @param int $jobId
     * @return SCORecord Fluent Interface
     */
    public function setJobId($jobId)
    {
        $this->jobId = (int) $jobId;
        return $this;
    }

    /**
     * Set the Account ID
     *
     * @param int $accountId
     * @return SCORecord Fluent Interface
     */
    public function setAccountId($accountId)
    {
        $this->accountId = (int) $accountId;
        return $this;
    }

    /**
     * Set the Job Status
     *
     * @param string $jobStatus
     * @return SCORecord Fluent Interface
     */
    public function setJobStatus($jobStatus)
    {
        $this->jobStatus = (string) $jobStatus;
        return $this;
    }

    /**
     * Set the Encoder Service Progress
     *
     * @param int $encoderServiceJobProgress
     * @return SCORecord Fluent Interface
     */
    public function setEncoderServiceJobProgress($encoderServiceJobProgress)
    {
        $this->encoderServiceJobProgress = (int) $encoderServiceJobProgress;
        return $this;
    }

    /**
     * Set if is Folder
     *
     * @param bool $isFolder
     * @return SCORecord Fluent Interface
     */
    public function setIsFolder($isFolder)
    {
        $this->isFolder = VT::toBoolean($isFolder);
        return $this;
    }

    /**
     * Set the Number of Downloads
     *
     * @param int $noOfDownloads
     * @return SCORecord Fluent Interface
     */
    public function setNoOfDownloads($noOfDownloads)
    {
        $this->noOfDownloads = (int) $noOfDownloads;
        return $this;
    }

    /**
     * Set the Name
     *
     * @param string $name
     * @return SCORecord Fluent Interface
     */
    public function setName($name)
    {
        $this->name = (string) $name;
        return $this;
    }

    /**
     * Set the URL
     *
     * @param string $urlPath
     * @return SCORecord Fluent Interface
     */
    public function setUrlPath($urlPath)
    {
        $this->urlPath = (string) $urlPath;
        return $this;
    }

    /**
     * Set the Begin date
     *
     * @param string|DateTimeImmutable $dateBegin
     * @return SCORecord Fluent Interface
     */
    public function setDateBegin($dateBegin)
    {
        $this->dateBegin = VT::toDateTimeImmutable($dateBegin);
        return $this;
    }

    /**
     * Set the End date
     *
     * @param string|DateTimeImmutable $dateEnd
     * @return SCORecord Fluent Interface
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = VT::toDateTimeImmutable($dateEnd);
        return $this;
    }

    /**
     * Set the Created date
     *
     * @param string|DateTimeImmutable $dateCreated
     * @return SCORecord Fluent Interface
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = VT::toDateTimeImmutable($dateCreated);
        return $this;
    }

    /**
     * Set the Modified date
     *
     * @param string|DateTimeImmutable $dateModified
     * @return SCORecord Fluent Interface
     */
    public function setDateModified($dateModified)
    {
        $this->dateModified = VT::toDateTimeImmutable($dateModified);
        return $this;
    }

    /**
     * Set the Duration
     *
     * @param DateInterval|string $duration
     * @return SCORecord Fluent Interface
     */
    public function setDuration($duration)
    {
        if (is_string($duration)) {
            $duration = $this->timeStringToDateInterval($duration);
        }
        $this->duration = $duration;
        return $this;
    }

    /**
     * Set the File name
     *
     * @param string $filename
     * @return SCORecord Fluent Interface
     */
    public function setFilename($filename)
    {
        $this->filename = (string) $filename;
        return $this;
    }

    /**
     * Converts the time duration string into a \DateInterval
     *
     * @param string $timeString A string like hh:mm:ss
     * @return DateInterval
     */
    protected function timeStringToDateInterval($timeString)
    {
        return new DateInterval(
            preg_replace(
                '/(\d{2}):(\d{2}):(\d{2}).*/',
                'PT$1H$2M$3S',
                $timeString
            )
        );
    }
}
