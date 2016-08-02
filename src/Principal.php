<?php

namespace Bruno\AdobeConnectClient;

use \Bruno\AdobeConnectClient\Helper\BooleanStr as B;
use \Bruno\AdobeConnectClient\Helper\CamelCase as CC;

/**
 * Adobe Connect Principal
 *
 * See {@link https://helpx.adobe.com/adobe-connect/webservices/common-xml-elements-attributes.html#type}
 *
 * @todo Maybe a factory for the differents types?
 */
class Principal implements Parameter
{
    /**
     * The built-in group Administrators, for Adobe Connect server Administrators.
     */
    const TYPE_ADMINS = 'admins';

    /**
     * The built-in group Authors, for authors.
     */
    const TYPE_AUTHORS = 'authors';

    /**
     * The built-in group Training Managers, for training managers.
     */
    const TYPE_COURSE_ADMINS = 'course-admins';

    /**
     * The built-in group Event Managers, for anyone who can create an Adobe Connect meeting.
     */
    const TYPE_EVENT_ADMINS = 'event-admins';

    /**
     * The group of users invited to an event.
     */
    const TYPE_EVENT_GROUP = 'event-group';

    /**
     * All Adobe Connect users.
     */
    const TYPE_EVERYONE = 'everyone';

    /**
     * A group authenticated from an external network.
     */
    const TYPE_EXTERNAL_GROUP = 'external-group';

    /**
     * A user authenticated from an external network.
     */
    const TYPE_EXTERNAL_USER = 'external-user';

    /**
     * A group that a user or Administrator creates.
     */
    const TYPE_GROUP = 'group';

    /**
     * A non-registered user who enters an Adobe Connect meeting room.
     */
    const TYPE_GUEST = 'guest';

    /**
     * The built-in group learners, for users who take courses.
     */
    const TYPE_LEARNERS = 'learners';

    /**
     * The built-in group Meeting Hosts, for Adobe Connect meeting hosts.
     */
    const TYPE_LIVE_ADMINS = 'live-admins';

    /**
     * The built-in group Seminar Hosts, for seminar hosts.
     */
    const TYPE_SEMINAR_ADMINS = 'seminar-admins';

    /**
     * A registered user on the server.
     */
    const TYPE_USER = 'user';

    /**
     * @var string
     */
    public $name = '';

    /**
     * @var string
     */
    public $login = '';

    /**
     * @var int
     */
    public $displayUid = 0;

    /**
     * @var int
     */
    public $principalId = 0;

    /**
     * @var boolean
     */
    public $isPrimary = false;

    /**
     * See {@link https://helpx.adobe.com/adobe-connect/webservices/common-xml-elements-attributes.html#type}
     *
     * @var string
     */
    public $type = '';

    /**
     * On create: If the principal is a group, use true. If the principal is a user, use false.
     *
     * @var boolean
     */
    public $hasChildren = false;

    /**
     * @var string
     */
    public $permissionId = '';

    /**
     * @var int
     */
    public $trainingGroupId = 0;

    /**
     * @var boolean
     */
    public $isEcommerce = false;

    /**
     * @var boolean
     */
    public $isHidden = false;

    /**
     * The new group’s description. Use only when creating a new group.
     *
     * @var string
     */
    public $description = '';

    /**
     * @var int
     */
    public $accountId = 0;

    /**
     * @var boolean
     */
    public $disabled = false;

    /**
     * Only for User
     *
     * @var string
     */
    public $email = '';

    /**
     * Only for User
     *
     * @var string
     */
    public $firstName = '';

    /**
     * Only for User
     *
     * @var string
     */
    public $lastName = '';

    /**
     * Only on create a User
     *
     * @var string
     */
    public $password = '';

    /**
     * Only on create a User
     * @var string
     */
    public $sendEmail = false;

    /**
     * @param \SimpleXMLElement $xmlElement
     */
    public function __construct(\SimpleXMLElement $principalElement = null)
    {
        if (!$principalElement) {
            return;
        }

        $this->name = (string) $principalElement->{'name'};
        $this->login = (string) $principalElement->{'login'};
        $this->displayUid = (string) $principalElement->{'display-uid'};
        $this->description = (string) $principalElement->{'description'};
        $this->email = (string) $principalElement->{'email'};
        $this->firstName = (string) $principalElement->{'first-name'};
        $this->lastName = (string) $principalElement->{'last-name'};

        $this->setWithAttributes($principalElement->attributes());
    }

    /**
     * Set with the node attributes.
     *
     * @param \SimpleXMLElement $xmlAttributes
     */
    protected function setWithAttributes(\SimpleXMLElement $xmlAttributes)
    {
        $this->principalId = intval($xmlAttributes->{'principal-id'});
        $this->isPrimary = B::toBoolean((string) $xmlAttributes->{'is-primary'});
        $this->type = (string) $xmlAttributes->{'type'};
        $this->hasChildren = B::toBoolean((string) $xmlAttributes->{'has-children'});
        $this->permissionId = (string) $xmlAttributes->{'permission-id'};
        $this->trainingGroupId = intval($xmlAttributes->{'training-group-id'});
        $this->accountId = intval($xmlAttributes->{'account-id'});
        $this->disabled = B::toBoolean($xmlAttributes->{'disabled'});
        $this->isEcommerce = B::toBoolean($xmlAttributes->{'is-ecommerce'});
        $this->isHidden = B::toBoolean($xmlAttributes->{'is-hidden'});
    }

    /**
     * The fields for create/update a User
     *
     * @return array
     */
    protected function fieldsForUser()
    {
        return [
            'hasChildren',
            'principalId',
            'firstName',
            'lastName',
            'login',
            'password',
            'email',
            'sendEmail',
            'type',
        ];
    }

    /**
     * The fields for create/update a Group
     *
     * @return array
     */
    protected function fieldsForGroup()
    {
        return [
            'hasChildren',
            'principalId',
            'name',
            'description',
            'type',
        ];
    }

    /**
     * Converts the items into an array with keys as param name and value as param value to send in the Request.
     * Only used to Create or Update an User or a Group.
     *
     * @return array
     */
    public function toArray()
    {
        $parameters = [];

        switch ($this->type) {
            case self::TYPE_USER:
                $fields = $this->fieldsForUser();
                break;

            case self::TYPE_GROUP:
                $fields = $this->fieldsForGroup();
                break;

            default:
                $fields = [];
        }

        foreach ($fields as $field) {
            $value = $this->$field;
            $parameters[CC::toHyphen($field)] = is_bool($value) ? B::toString($value) : $value;
        }
        return $parameters;
    }
}
