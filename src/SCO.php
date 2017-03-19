<?php

namespace AdobeConnectClient;

/**
 * Adobe Connect SCO
 *
 * See {@link https://helpx.adobe.com/adobe-connect/webservices/common-xml-elements-attributes.html#type}
 *
 */
class SCO implements Parameter, EntityInterface
{
    use Traits\ParameterTrait;
    use Traits\EntityTrait;

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
     * A event.
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

    /** @var \DateTimeImmutable */
    protected $dateCreated = null;

    /** @var \DateTimeImmutable */
    protected $dateModified = null;

    /** @var string */
    protected $description = null;

    /** @var string */
    protected $name = null;

    /** @var string */
    protected $urlPath = null;

    /** @var \DateTimeImmutable */
    protected $dateBegin = null;

    /** @var \DateTimeImmutable */
    protected $dateEnd = null;

    /** @var boolean */
    protected $meetingPodsLayoutsLocked = null;

    /** @var boolean */
    protected $updateLinkedItem = null;

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
     * @return boolean
     */
    public function getDisabled()
    {
        return $this->disabled;
    }

    /**
     *
     * @return int
     */
    public function getDisplaySeq()
    {
        return $this->displaySeq;
    }

    /**
     *
     * @return int
     */
    public function getFolderId()
    {
        return $this->folderId;
    }

    /**
     *
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     *
     * @return string
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     *
     * @return int
     */
    public function getMaxRetries()
    {
        return $this->maxRetries;
    }

    /**
     *
     * @return int
     */
    public function getScoId()
    {
        return $this->scoId;
    }

    /**
     *
     * @return int
     */
    public function getSourceScoId()
    {
        return $this->sourceScoId;
    }

    /**
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
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
     * @return \DateTimeImmutable
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     *
     * @return \DateTimeImmutable
     */
    public function getDateModified()
    {
        return $this->dateModified;
    }

    /**
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     *
     * @return string
     */
    public function getUrlPath()
    {
        return $this->urlPath;
    }

    /**
     *
     * @return \DateTimeImmutable
     */
    public function getDateBegin()
    {
        return $this->dateBegin;
    }

    /**
     *
     * @return \DateTimeImmutable
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     *
     * @return boolean
     */
    public function getMeetingPodsLayoutsLocked()
    {
        return $this->meetingPodsLayoutsLocked;
    }

    /**
     *
     * @return boolean
     */
    public function getUpdateLinkedItem()
    {
        return $this->updateLinkedItem;
    }

    /**
     *
     * @return int
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;
        return $this;
    }

    /**
     *
     * @param boolean $disabled
     * @return $this Fluent Interface
     */
    public function setDisabled($disabled)
    {
        $this->disabled = $disabled;
        return $this;
    }

    /**
     *
     * @param int $displaySeq
     * @return $this Fluent Interface
     */
    public function setDisplaySeq($displaySeq)
    {
        $this->displaySeq = $displaySeq;
        return $this;
    }

    /**
     *
     * @param int $folderId
     * @return $this Fluent Interface
     */
    public function setFolderId($folderId)
    {
        $this->folderId = $folderId;
        return $this;
    }

    /**
     *
     * @param string $icon
     * @return $this Fluent Interface
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
        return $this;
    }

    /**
     *
     * @param string $lang
     * @return $this Fluent Interface
     */
    public function setLang($lang)
    {
        $this->lang = $lang;
        return $this;
    }

    /**
     *
     * @param int $maxRetries
     * @return $this Fluent Interface
     */
    public function setMaxRetries($maxRetries)
    {
        $this->maxRetries = $maxRetries;
        return $this;
    }

    /**
     *
     * @param int $scoId
     * @return $this Fluent Interface
     */
    public function setScoId($scoId)
    {
        $this->scoId = $scoId;
        return $this;
    }

    /**
     *
     * @param int $sourceScoId
     * @return $this Fluent Interface
     */
    public function setSourceScoId($sourceScoId)
    {
        $this->sourceScoId = $sourceScoId;
        return $this;
    }

    /**
     *
     * @param string $type
     * @return $this Fluent Interface
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
            throw new \DomainException("Type {$type} isn't valid");
        }
        $this->type = $type;
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
     * @param \DateTimeImmutable $dateCreated
     * @return $this Fluent Interface
     */
    public function setDateCreated(\DateTimeImmutable $dateCreated)
    {
        $this->dateCreated = $dateCreated;
        return $this;
    }

    /**
     *
     * @param \DateTimeImmutable $dateModified
     * @return $this Fluent Interface
     */
    public function setDateModified(\DateTimeImmutable $dateModified)
    {
        $this->dateModified = $dateModified;
        return $this;
    }

    /**
     *
     * @param string $description
     * @return $this Fluent Interface
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     *
     * @param string $name
     * @return $this Fluent Interface
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     *
     * @param string $urlPath
     * @return $this Fluent Interface
     */
    public function setUrlPath($urlPath)
    {
        $this->urlPath = $urlPath;
        return $this;
    }

    /**
     *
     * @param \DateTimeImmutable $dateBegin
     * @return $this Fluent Interface
     */
    public function setDateBegin(\DateTimeImmutable $dateBegin)
    {
        $this->dateBegin = $dateBegin;
        return $this;
    }

    /**
     *
     * @param \DateTimeImmutable $dateEnd
     * @return $this Fluent Interface
     */
    public function setDateEnd(\DateTimeImmutable $dateEnd)
    {
        $this->dateEnd = $dateEnd;
        return $this;
    }

    /**
     *
     * @param boolean $meetingPodsLayoutsLocked
     * @return $this Fluent Interface
     */
    public function setMeetingPodsLayoutsLocked($meetingPodsLayoutsLocked)
    {
        $this->meetingPodsLayoutsLocked = $meetingPodsLayoutsLocked;
        return $this;
    }

    /**
     *
     * @param boolean $updateLinkedItem
     * @return $this Fluent Interface
     */
    public function setUpdateLinkedItem($updateLinkedItem)
    {
        $this->updateLinkedItem = $updateLinkedItem;
        return $this;
    }
}
