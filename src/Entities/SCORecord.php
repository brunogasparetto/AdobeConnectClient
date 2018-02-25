<?php

namespace AdobeConnectClient\Entities;

use DateTimeImmutable;
use DateInterval;
use Exception;
use InvalidArgumentException;
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
     */
    public function setScoId($scoId)
    {
        $this->scoId = (int) $scoId;
    }

    /**
     * Set the Source ID
     *
     * @param int $sourceScoId
     */
    public function setSourceScoId($sourceScoId)
    {
        $this->sourceScoId = (int) $sourceScoId;
    }

    /**
     * Set the Folder ID
     *
     * @param int $folderId
     */
    public function setFolderId($folderId)
    {
        $this->folderId = (int) $folderId;
    }

    /**
     * Set the Type
     *
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = (string) $type;
    }

    /**
     * Set the Icon
     *
     * @param string $icon
     */
    public function setIcon($icon)
    {
        $this->icon = (string) $icon;
    }

    /**
     * Set the Display sequence
     *
     * @param int $displaySeq
     */
    public function setDisplaySeq($displaySeq)
    {
        $this->displaySeq = (int) $displaySeq;
    }

    /**
     * Set the Job ID
     *
     * @param int $jobId
     */
    public function setJobId($jobId)
    {
        $this->jobId = (int) $jobId;
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

    /**
     * Set the Job Status
     *
     * @param string $jobStatus
     */
    public function setJobStatus($jobStatus)
    {
        $this->jobStatus = (string) $jobStatus;
    }

    /**
     * Set the Encoder Service Progress
     *
     * @param int $encoderServiceJobProgress
     */
    public function setEncoderServiceJobProgress($encoderServiceJobProgress)
    {
        $this->encoderServiceJobProgress = (int) $encoderServiceJobProgress;
    }

    /**
     * Set if is Folder
     *
     * @param bool $isFolder
     */
    public function setIsFolder($isFolder)
    {
        $this->isFolder = VT::toBoolean($isFolder);
    }

    /**
     * Set the Number of Downloads
     *
     * @param int $noOfDownloads
     */
    public function setNoOfDownloads($noOfDownloads)
    {
        $this->noOfDownloads = (int) $noOfDownloads;
    }

    /**
     * Set the Name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = (string) $name;
    }

    /**
     * Set the URL
     *
     * @param string $urlPath
     */
    public function setUrlPath($urlPath)
    {
        $this->urlPath = (string) $urlPath;
    }

    /**
     * Set the Begin date
     *
     * @param string|DateTimeImmutable $dateBegin
     */
    public function setDateBegin($dateBegin)
    {
        $this->dateBegin = VT::toDateTimeImmutable($dateBegin);
    }

    /**
     * Set the End date
     *
     * @param string|DateTimeImmutable $dateEnd
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = VT::toDateTimeImmutable($dateEnd);
    }

    /**
     * Set the Created date
     *
     * @param string|DateTimeImmutable $dateCreated
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = VT::toDateTimeImmutable($dateCreated);
    }

    /**
     * Set the Modified date
     *
     * @param string|DateTimeImmutable $dateModified
     */
    public function setDateModified($dateModified)
    {
        $this->dateModified = VT::toDateTimeImmutable($dateModified);
    }

    /**
     * Set the Duration
     *
     * @param DateInterval|string $duration
     * @throws InvalidArgumentException
     */
    public function setDuration($duration)
    {
        if (is_string($duration)) {
            $duration = $this->timeStringToDateInterval($duration);
        }
        $this->duration = $duration;
    }

    /**
     * Set the File name
     *
     * @param string $filename
     */
    public function setFilename($filename)
    {
        $this->filename = (string) $filename;
    }

    /**
     * Converts the time duration string into a \DateInterval
     *
     * @param string $timeString A string like hh:mm:ss
     * @return DateInterval
     * @throws InvalidArgumentException
     */
    protected function timeStringToDateInterval($timeString)
    {
        try {
            return new DateInterval(
                preg_replace(
                    '/(\d{2}):(\d{2}):(\d{2}).*/',
                    'PT$1H$2M$3S',
                    $timeString
                )
            );
        } catch (Exception $e) {
            throw new InvalidArgumentException('Timestring is not a valid interval');
        }
    }
}
