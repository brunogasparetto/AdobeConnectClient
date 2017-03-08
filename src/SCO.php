<?php

namespace AdobeConnectClient;

use \AdobeConnectClient\Helper\BooleanStr as B;

/**
 * Adobe Connect SCO
 *
 * See {@link https://helpx.adobe.com/adobe-connect/webservices/common-xml-elements-attributes.html#type}
 *
 */
class SCO implements Parameter
{
    use Traits\ParameterTrait;

    /**
     * A viewable file uploaded to the server, for example, an FLV file, an HTML file, an image, a pod, and so on.
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
    public $accountId = 0;

    /**
     * @var boolean
     */
    public $disabled = false;

    /**
     * @var int
     */
    public $displaySeq = 0;

    /**
     * @var int
     */
    public $folderId = 0;

    /**
     * @var string
     */
    public $icon = '';

    /**
     * @var string
     */
    public $lang = '';

    /**
     * @var int
     */
    public $maxRetries = 0;

    /**
     * @var int
     */
    public $scoId = 0;

    /**
     * @var int
     */
    public $sourceScoId = 0;

    /**
     * @var string
     */
    public $type = '';

    /**
     * @var string
     */
    public $version = '';

    /**
     * @var \DateTimeImmutable
     */
    public $dateCreated = null;

    /**
     * @var \DateTimeImmutable
     */
    public $dateModified = null;

    /**
     * @var string
     */
    public $description = '';

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
    public $dateEnd = null;

    /**
     * @var boolean
     */
    public $meetingPodsLayoutsLocked = false;

    /**
     * @var boolean
     */
    public $updateLinkedItem = false;

    /**
     * @param \SimpleXMLElement $xmlElement
     */
    public function __construct(\SimpleXMLElement $xmlElement = null)
    {
        if (!$xmlElement) {
            return;
        }

        $this->setWithAttributes($xmlElement->attributes());

        $this->dateCreated = new \DateTimeImmutable((string) $xmlElement->{'date-created'});
        $this->dateModified = new \DateTimeImmutable((string) $xmlElement->{'date-modified'});
        $this->description = (string) $xmlElement->{'description'};
        $this->name = (string) $xmlElement->{'name'};
        $this->urlPath = (string) $xmlElement->{'url-path'};

        if ($this->type === self::TYPE_MEETING) {
            $this->setMeetingItems($xmlElement);
        }
    }

    /**
     * Set with the node attributes.
     *
     * @param \SimpleXMLElement $xmlAttributes
     */
    protected function setWithAttributes(\SimpleXMLElement $xmlAttributes)
    {
        $this->accountId = intval($xmlAttributes->{'account-id'});
        $this->disabled = (string) $xmlAttributes->{'disabled'};
        $this->displaySeq = intval($xmlAttributes->{'display-seq'});
        $this->folderId = intval($xmlAttributes->{'folder-id'});
        $this->icon = (string) $xmlAttributes->{'icon'};
        $this->lang = (string) $xmlAttributes->{'lang'};
        $this->maxRetries = (string) $xmlAttributes->{'max-retries'};
        $this->scoId = intval($xmlAttributes->{'sco-id'});
        $this->sourceScoId = intval($xmlAttributes->{'source-sco-id'});
        $this->type = mb_strtolower((string) $xmlAttributes->{'type'});
        $this->version = (string) $xmlAttributes->{'version'};
    }

    /**
     * Set Meeting's items
     *
     * @param \SimpleXMLElement $xmlElement
     */
    protected function setMeetingItems(\SimpleXMLElement $xmlElement)
    {
        $this->dateBegin = new \DateTimeImmutable((string) $xmlElement->{'date-begin'});
        $this->dateEnd = new \DateTimeImmutable((string) $xmlElement->{'date-end'});
        $this->meetingPodsLayoutsLocked = B::toBoolean((string) $xmlElement->{'meeting-pods-layouts-locked'});
        $this->updateLinkedItem = B::toBoolean((string) $xmlElement->{'update-linked-item'});
    }
}
