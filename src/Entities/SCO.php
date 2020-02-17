<?php
declare(strict_types=1);

namespace AdobeConnectClient\Entities;

use DateTimeInterface;
use DateTimeImmutable;
use DomainException;
use AdobeConnectClient\ArrayableInterface;
use AdobeConnectClient\Helpers\ValueTransform as VT;
use AdobeConnectClient\Traits\Arrayable as ArrayableTrait;

/**
 * Adobe Connect SCO
 *
 * See {@link https://helpx.adobe.com/adobe-connect/webservices/common-xml-elements-attributes.html#type}
 *
 */
class SCO implements ArrayableInterface
{
    use ArrayableTrait;

    /**
     * A viewable file uploaded to the server.
     * For example, an FLV file, an HTML file, an image, a pod, and so on.
     * @var string
     */
    const TYPE_CONTENT = 'content';

    /**
     * A curriculum.
     * @var string
     */
    const TYPE_CURRICULUM = 'curriculum';

    /**
     * An event.
     * @var string
     */
    const TYPE_EVENT = 'event';

    /**
     * A folder on the server’s hard disk that contains content.
     * @var string
     */
    const TYPE_FOLDER = 'folder';

    /**
     * A reference to another SCO. These links are used by curriculums to link to other SCOs.
     * When content is added to a curriculum, a link is created from the curriculum to the content.
     * @var string
     */
    const TYPE_LINK = 'link';

    /**
     * An Adobe Connect meeting.
     * @var string
     */
    const TYPE_MEETING = 'meeting';

    /**
     * One occurrence of a recurring Adobe Connect meeting.
     * @var string
     */
    const TYPE_SESSION = 'session';

    /**
     * The root of a folder hierarchy. A tree’s root is treated as an independent hierarchy;
     * you can’t determine the parent folder of a tree from inside the tree.
     * @var string
     */
    const TYPE_TREE = 'tree';

    /**
     * @var int
     */
    protected $accountId = null;

    /**
     * @var bool
     */
    protected $disabled = null;

    /**
     * @var int
     */
    protected $displaySeq = null;

    /**
     * @var int
     */
    protected $folderId = null;

    /**
     * @var string
     */
    protected $icon = null;

    /**
     * @var string
     */
    protected $lang = null;

    /**
     * @var int
     */
    protected $maxRetries = null;

    /**
     * @var int
     */
    protected $scoId = null;

    /**
     * @var int
     */
    protected $sourceScoId = null;

    /**
     * @var string
     */
    protected $type = null;

    /**
     * @var string
     */
    protected $version = null;

    /**
     * @var DateTimeImmutable
     */
    protected $dateCreated = null;

    /**
     * @var DateTimeImmutable
     */
    protected $dateModified = null;

    /**
     * @var string
     */
    protected $description = null;

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
    protected $dateEnd = null;

    /**
     * @var bool
     */
    protected $meetingPodsLayoutsLocked = null;

    /**
     * @var bool
     */
    protected $updateLinkedItem = null;

    /**
     * Create a new SCO Instance
     *
     * @return SCO
     */
    public static function instance(): SCO
    {
        return new static();
    }

    /**
     * Get the Account ID
     *
     * @return int
     */
    public function getAccountId(): int
    {
        return $this->accountId;
    }

    /**
     * Get the  disabled indicator
     *
     * @return bool
     */
    public function getDisabled(): bool
    {
        return $this->disabled;
    }

    /**
     * Get the display sequence
     *
     * @return int
     */
    public function getDisplaySeq(): int
    {
        return $this->displaySeq;
    }

    /**
     * Get the Folder ID
     *
     * @return int
     */
    public function getFolderId(): int
    {
        return $this->folderId;
    }

    /**
     * Get the icon
     *
     * @return string
     */
    public function getIcon(): string
    {
        return $this->icon;
    }

    /**
     * Get the language
     *
     * @return string
     */
    public function getLang(): string
    {
        return $this->lang;
    }

    /**
     * Get the max retries
     *
     * @return int
     */
    public function getMaxRetries(): int
    {
        return $this->maxRetries;
    }

    /**
     * Get the SCO ID
     *
     * @return int
     */
    public function getScoId(): int
    {
        return $this->scoId;
    }

    /**
     * Get the Source ID
     *
     * @return int
     */
    public function getSourceScoId(): int
    {
        return $this->sourceScoId;
    }

    /**
     * Get the type
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Get the version
     *
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * Get the Creation Date
     *
     * @return DateTimeImmutable
     */
    public function getDateCreated(): DateTimeImmutable
    {
        return $this->dateCreated;
    }

    /**
     * Get the Modified date
     *
     * @return DateTimeImmutable
     */
    public function getDateModified(): DateTimeImmutable
    {
        return $this->dateModified;
    }

    /**
     * Get the description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Get the name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the URL
     *
     * @return string
     */
    public function getUrlPath(): string
    {
        return $this->urlPath;
    }

    /**
     * Get the time Begins the meeting
     *
     * @return DateTimeImmutable
     */
    public function getDateBegin(): DateTimeImmutable
    {
        return $this->dateBegin;
    }

    /**
     * Get the time End the meeting
     *
     * @return DateTimeImmutable
     */
    public function getDateEnd(): DateTimeImmutable
    {
        return $this->dateEnd;
    }

    /**
     * Get the Pod layout locked status
     *
     * @return bool
     */
    public function getMeetingPodsLayoutsLocked(): bool
    {
        return $this->meetingPodsLayoutsLocked;
    }

    /**
     * Get the linked item update status
     *
     * @return bool
     */
    public function getUpdateLinkedItem(): bool
    {
        return $this->updateLinkedItem;
    }

    /**
     * Set the Account ID
     *
     * @param int $accountId The account ID
     * @return SCO
     */
    public function setAccountId($accountId): self
    {
        $this->accountId = intval($accountId);
        return $this;
    }

    /**
     * Set the disabled status
     *
     * @param bool $disabled
     * @return SCO
     */
    public function setDisabled($disabled): self
    {
        $this->disabled = VT::toBool($disabled);
        return $this;
    }

    /**
     * Set the Display Sequence
     *
     * @param int $displaySeq
     * @return SCO
     */
    public function setDisplaySeq($displaySeq): self
    {
        $this->displaySeq = intval($displaySeq);
        return $this;
    }

    /**
     * Set the Folder ID
     *
     * @param int $folderId
     * @return SCO
     */
    public function setFolderId($folderId): self
    {
        $this->folderId = intval($folderId);
        return $this;
    }

    /**
     * Set the Icon
     *
     * @param string $icon
     * @return SCO
     */
    public function setIcon($icon): self
    {
        $this->icon = (string) $icon;
        return $this;
    }

    /**
     * Set the Language
     *
     * @param string $lang
     * @return SCO
     */
    public function setLang($lang): self
    {
        $this->lang = (string) $lang;
        return $this;
    }

    /**
     * Set the Max retries
     *
     * @param int $maxRetries
     * @return SCO
     */
    public function setMaxRetries($maxRetries): self
    {
        $this->maxRetries = intval($maxRetries);
        return $this;
    }

    /**
     * Set the SCO ID
     *
     * @param int $scoId
     * @return SCO
     */
    public function setScoId($scoId): self
    {
        $this->scoId = intval($scoId);
        return $this;
    }

    /**
     * Set the Source ID
     * @param int $sourceScoId
     * @return SCO
     */
    public function setSourceScoId($sourceScoId): self
    {
        $this->sourceScoId = intval($sourceScoId);
        return $this;
    }

    /**
     * Set the Type
     *
     * @param string $type
     * @return SCO
     * @throws DomainException
     */
    public function setType($type): self
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
            throw new DomainException("{$type} isn't a valid SCO Type");
        }
        $this->type = $type;
        return $this;
    }

    /**
     * Set the Version
     *
     * @param string $version
     * @return SCO
     */
    public function setVersion($version): self
    {
        $this->version = (string) $version;
        return $this;
    }

    /**
     * Set the Created Date
     *
     * @param DateTimeInterface|string $dateCreated
     * @return SCO
     */
    public function setDateCreated($dateCreated): self
    {
        $this->dateCreated = VT::toDateTimeImmutable($dateCreated);
        return $this;
    }

    /**
     * Set the Modified Date
     *
     * @param DateTimeInterface|string $dateModified
     * @return SCO
     */
    public function setDateModified($dateModified): self
    {
        $this->dateModified = VT::toDateTimeImmutable($dateModified);
        return $this;
    }

    /**
     * Set the Description
     *
     * @param string $description
     * @return SCO
     */
    public function setDescription($description): self
    {
        $this->description = (string) $description;
        return $this;
    }

    /**
     * Set the Name
     *
     * @param string $name
     * @return SCO
     */
    public function setName($name): self
    {
        $this->name = (string) $name;
        return $this;
    }

    /**
     * Set the URL
     *
     * @param string $urlPath
     * @return SCO
     */
    public function setUrlPath($urlPath): self
    {
        $this->urlPath = (string) $urlPath;
        return $this;
    }

    /**
     * Set the time Meeting begin
     *
     * @param DateTimeInterface|string $dateBegin
     * @return SCO
     */
    public function setDateBegin($dateBegin): self
    {
        $this->dateBegin = VT::toDateTimeImmutable($dateBegin);
        return $this;
    }

    /**
     * Set the time Meeting end
     *
     * @param DateTimeInterface|string $dateEnd
     * @return SCO
     */
    public function setDateEnd($dateEnd): self
    {
        $this->dateEnd = VT::toDateTimeImmutable($dateEnd);
        return $this;
    }

    /**
     * Set the Pods Layout locked status
     *
     * @param bool $meetingPodsLayoutsLocked
     * @return SCO
     */
    public function setMeetingPodsLayoutsLocked($meetingPodsLayoutsLocked): self
    {
        $this->meetingPodsLayoutsLocked = VT::toBool($meetingPodsLayoutsLocked);
        return $this;
    }

    /**
     * Set the linked item status
     *
     * @param bool $updateLinkedItem
     * @return SCO
     */
    public function setUpdateLinkedItem($updateLinkedItem): self
    {
        $this->updateLinkedItem = VT::toBool($updateLinkedItem);
        return $this;
    }
}
