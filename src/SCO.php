<?php

namespace AdobeConnectClient;

use DateTimeImmutable;
use AdobeConnectClient\Helpers\BooleanTransform as BT;

/**
 * Adobe Connect SCO
 *
 * See {@link https://helpx.adobe.com/adobe-connect/webservices/common-xml-elements-attributes.html#type}
 *
 */
class SCO implements ParameterInterface
{
    use Traits\ParameterTrait;

    /**
     * A viewable file uploaded to the server.
     * For example, an FLV file, an HTML file, an image, a pod, and so on.
     */
    const TYPE_CONTENT = 'content';

    /**
     * A curriculum.
     */
    const TYPE_CURRICULUM = 'curriculum';

    /**
     * An event.
     */
    const TYPE_EVENT = 'event';

    /**
     * A folder on the server’s hard disk that contains content.
     */
    const TYPE_FOLDER = 'folder';

    /**
     * A reference to another SCO. These links are used by curriculums to link to other SCOs.
     * When content is added to a curriculum, a link is created from the curriculum to the content.
     */
    const TYPE_LINK = 'link';

    /**
     * An Adobe Connect meeting.
     */
    const TYPE_MEETING = 'meeting';

    /**
     * One occurrence of a recurring Adobe Connect meeting.
     */
    const TYPE_SESSION = 'session';

    /**
     * The root of a folder hierarchy. A tree’s root is treated as an independent hierarchy;
     * you can’t determine the parent folder of a tree from inside the tree.
     */
    const TYPE_TREE = 'tree';

    /**
     * @var int
     */
    protected $accountId = null;

    /** @var boolean */
    protected $disabled = null;

    /** @var int */
    protected $displaySeq = null;

    /** @var int */
    protected $folderId = null;

    /** @var string */
    protected $icon = null;

    /** @var string */
    protected $lang = null;

    /** @var int */
    protected $maxRetries = null;

    /** @var int */
    protected $scoId = null;

    /** @var int */
    protected $sourceScoId = null;

    /** @var string */
    protected $type = null;

    /** @var string */
    protected $version = null;

    /** @var DateTimeImmutable */
    protected $dateCreated = null;

    /** @var DateTimeImmutable */
    protected $dateModified = null;

    /** @var string */
    protected $description = null;

    /** @var string */
    protected $name = null;

    /** @var string */
    protected $urlPath = null;

    /** @var DateTimeImmutable */
    protected $dateBegin = null;

    /** @var DateTimeImmutable */
    protected $dateEnd = null;

    /** @var boolean */
    protected $meetingPodsLayoutsLocked = null;

    /** @var boolean */
    protected $updateLinkedItem = null;

    public static function instance()
    {
        return new static;
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
     * Get the  disabled indicator
     *
     * @return boolean
     */
    public function getDisabled()
    {
        return $this->disabled;
    }

    /**
     * Get the display sequence
     *
     * @return int
     */
    public function getDisplaySeq()
    {
        return $this->displaySeq;
    }

    /**
     * Get the Folder ID
     *
     * @return int
     */
    public function getFolderId()
    {
        return $this->folderId;
    }

    /**
     * Get the icon
     *
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Get the language
     *
     * @return string
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * Get the max retries
     *
     * @return int
     */
    public function getMaxRetries()
    {
        return $this->maxRetries;
    }

    /**
     * Get the SCO ID
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
     * Get the type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get the version
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Get the Creation Date
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
     * Get the description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the name
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
     * Get the time Begins the meeting
     *
     * @return DateTimeImmutable
     */
    public function getDateBegin()
    {
        return $this->dateBegin;
    }

    /**
     * Get the time End the meeting
     *
     * @return DateTimeImmutable
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * Get the Pod layout locked status
     *
     * @return boolean
     */
    public function getMeetingPodsLayoutsLocked()
    {
        return $this->meetingPodsLayoutsLocked;
    }

    /**
     * Get the linked item update status
     *
     * @return boolean
     */
    public function getUpdateLinkedItem()
    {
        return $this->updateLinkedItem;
    }

    /**
     * Set the Account ID
     *
     * @return SCO Fluent Interface
     */
    public function setAccountId($accountId)
    {
        $this->accountId = (int) $accountId;
        return $this;
    }

    /**
     * Set the disabled status
     *
     * @param boolean $disabled
     * @return SCO Fluent Interface
     */
    public function setDisabled($disabled)
    {
        $this->disabled = BT::toBoolean($disabled);
        return $this;
    }

    /**
     * Set the Display Sequence
     *
     * @param int $displaySeq
     * @return SCO Fluent Interface
     */
    public function setDisplaySeq($displaySeq)
    {
        $this->displaySeq = (int) $displaySeq;
        return $this;
    }

    /**
     * Set the Folder ID
     *
     * @param int $folderId
     * @return SCO Fluent Interface
     */
    public function setFolderId($folderId)
    {
        $this->folderId = (int) $folderId;
        return $this;
    }

    /**
     * Set the Icon
     *
     * @param string $icon
     * @return SCO Fluent Interface
     */
    public function setIcon($icon)
    {
        $this->icon = (string) $icon;
        return $this;
    }

    /**
     * Set the Language
     *
     * @param string $lang
     * @return SCO Fluent Interface
     */
    public function setLang($lang)
    {
        $this->lang = (string) $lang;
        return $this;
    }

    /**
     * Set the Max retries
     *
     * @param int $maxRetries
     * @return SCO Fluent Interface
     */
    public function setMaxRetries($maxRetries)
    {
        $this->maxRetries = (int) $maxRetries;
        return $this;
    }

    /**
     * Set the SCO ID
     *
     * @param int $scoId
     * @return SCO Fluent Interface
     */
    public function setScoId($scoId)
    {
        $this->scoId = (int) $scoId;
        return $this;
    }

    /**
     * Set the Source ID
     * @param int $sourceScoId
     * @return SCO Fluent Interface
     */
    public function setSourceScoId($sourceScoId)
    {
        $this->sourceScoId = (int) $sourceScoId;
        return $this;
    }

    /**
     * Set the Type
     *
     * @param string $type
     * @return SCO Fluent Interface
     * @throws \DomainException
     */
    public function setType($type)
    {
        if (!in_array(
                $type,
                [
                    self::TYPE_CONTENT,
                    self::TYPE_CURRICULUM,
                    self::TYPE_EVENT,
                    self::TYPE_FOLDER,
                    self::TYPE_LINK,
                    self::TYPE_MEETING,
                    self::TYPE_SESSION,
                    self::TYPE_TREE
                ]
        )) {
            throw new \DomainException("{$type} isn't a valid SCO Type");
        }
        $this->type = $type;
        return $this;
    }

    /**
     * Set the Version
     *
     * @param string $version
     * @return SCO Fluent Interface
     */
    public function setVersion($version)
    {
        $this->version = (string) $version;
        return $this;
    }

    /**
     * Set the Created Date
     *
     * @param string|DateTimeImmutable $dateCreated
     * @return SCO Fluent Interface
     */
    public function setDateCreated($dateCreated)
    {
        if (is_string($dateCreated)) {
            $this->dateCreated = new DateTimeImmutable($dateCreated);
        } elseif ($dateCreated instanceof DateTimeImmutable) {
            $this->dateCreated = $dateCreated;
        } else {
            throw new \InvalidArgumentException('Date Created must be a valid date string or a DateTimeImmutable object');
        }
        return $this;
    }

    /**
     * Set the Modified Date
     *
     * @param string|DateTimeImmutable $dateModified
     * @return SCO Fluent Interface
     */
    public function setDateModified($dateModified)
    {
        if (is_string($dateModified)) {
            $this->dateModified = new DateTimeImmutable($dateModified);
        } elseif ($dateModified instanceof DateTimeImmutable) {
            $this->dateModified = $dateModified;
        } else {
            throw new \InvalidArgumentException('Date Modified must be a valid date string or a DateTimeImmutable object');
        }
        return $this;
    }

    /**
     * Set the Description
     *
     * @param string $description
     * @return SCO Fluent Interface
     */
    public function setDescription($description)
    {
        $this->description = (string) $description;
        return $this;
    }

    /**
     * Set the Name
     *
     * @param string $name
     * @return SCO Fluent Interface
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
     * @return SCO Fluent Interface
     */
    public function setUrlPath($urlPath)
    {
        $this->urlPath = (string) $urlPath;
        return $this;
    }

    /**
     * Set the time Meeting begin
     *
     * @param string|DateTimeImmutable $dateBegin
     * @return SCO Fluent Interface
     */
    public function setDateBegin($dateBegin)
    {
        if (is_string($dateBegin)) {
            $this->dateBegin = new DateTimeImmutable($dateBegin);
        } elseif ($dateBegin instanceof DateTimeImmutable) {
            $this->dateBegin = $dateBegin;
        } else {
            throw new \InvalidArgumentException('Date Begin must be a valid date string or a DateTimeImmutable object');
        }
        return $this;
    }

    /**
     * Set the time Meeting end
     *
     * @param string|DateTimeImmutable $dateEnd
     * @return SCO Fluent Interface
     */
    public function setDateEnd($dateEnd)
    {
        if (is_string($dateEnd)) {
            $this->dateEnd = new DateTimeImmutable($dateEnd);
        } elseif ($dateEnd instanceof DateTimeImmutable) {
            $this->dateEnd = $dateEnd;
        } else {
            throw new \InvalidArgumentException('Date End must be a valid date string or a DateTimeImmutable object');
        }
        return $this;
    }

    /**
     * Set the Pods Layout locked status
     *
     * @param boolean $meetingPodsLayoutsLocked
     * @return SCO Fluent Interface
     */
    public function setMeetingPodsLayoutsLocked($meetingPodsLayoutsLocked)
    {
        $this->meetingPodsLayoutsLocked = BT::toBoolean($meetingPodsLayoutsLocked);
        return $this;
    }

    /**
     * Set the linked item status
     *
     * @param boolean $updateLinkedItem
     * @return SCO Fluent Interface
     */
    public function setUpdateLinkedItem($updateLinkedItem)
    {
        $this->updateLinkedItem = BT::toBoolean($updateLinkedItem);
        return $this;
    }
}
