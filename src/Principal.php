<?php

namespace AdobeConnectClient;

use \AdobeConnectClient\Helpers\BooleanTransform as BT;
use \AdobeConnectClient\Helpers\StringCaseTransform as SCT;

/**
 * Adobe Connect Principal
 *
 * See {@link https://helpx.adobe.com/adobe-connect/webservices/common-xml-elements-attributes.html#type}
 *
 * @todo Maybe a factory for the differents types?
 */
class Principal implements ParameterInterface
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
    protected $name = null;

    /**
     * @var string
     */
    protected $login = null;

    /**
     * @var int
     */
    protected $displayUid = null;

    /**
     * @var int
     */
    protected $principalId = null;

    /**
     * @var bool
     */
    protected $isPrimary = null;

    /**
     * See {@link https://helpx.adobe.com/adobe-connect/webservices/common-xml-elements-attributes.html#type}
     *
     * @var string
     */
    protected $type = null;

    /**
     * On create: If the principal is a group, use true. If the principal is a user, use false.
     *
     * @var bool
     */
    protected $hasChildren = null;

    /**
     * @var string
     */
    protected $permissionId = null;

    /**
     * @var int
     */
    protected $trainingGroupId = null;

    /**
     * @var bool
     */
    protected $isEcommerce = null;

    /**
     * @var bool
     */
    protected $isHidden = null;

    /**
     * The new group’s description. Use only when creating a new group.
     *
     * @var string
     */
    protected $description = null;

    /**
     * @var int
     */
    protected $accountId = null;

    /**
     * @var bool
     */
    protected $disabled = null;

    /**
     * Only for User
     *
     * @var string
     */
    protected $email = null;

    /**
     * Only for User
     *
     * @var string
     */
    protected $firstName = null;

    /**
     * Only for User
     *
     * @var string
     */
    protected $lastName = null;

    /**
     * Only on create a User
     *
     * @var string
     */
    protected $password = null;

    /**
     * Only on create a User
     * @var string
     */
    protected $sendEmail = null;

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

            if (isset($value)) {
                $parameters[SCT::toHyphen($field)] = is_bool($value)
                    ? BT::toString($value)
                    : $value;
            }
        }
        return $parameters;
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
     * Get the Login
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Get the UID
     *
     * @return int
     */
    public function getDisplayUid()
    {
        return $this->displayUid;
    }

    /**
     * Get the ID
     *
     * @return int
     */
    public function getPrincipalId()
    {
        return $this->principalId;
    }

    /**
     * Indicate if Is Primary
     *
     * @return bool
     */
    public function getIsPrimary()
    {
        return $this->isPrimary;
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
     * Indicate if Has Children
     *
     * @return bool
     */
    public function getHasChildren()
    {
        return $this->hasChildren;
    }

    /**
     * Get the Permission ID
     *
     * @return string
     */
    public function getPermissionId()
    {
        return $this->permissionId;
    }

    /**
     * Get the Training Groupd ID
     *
     * @return int
     */
    public function getTrainingGroupId()
    {
        return $this->trainingGroupId;
    }

    /**
     * Indicate if Is E-Commerce
     *
     * @return bool
     */
    public function getIsEcommerce()
    {
        return $this->isEcommerce;
    }

    /**
     * Indicate if Is Hidden
     *
     * @return bool
     */
    public function getIsHidden()
    {
        return $this->isHidden;
    }

    /**
     * Get the Description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
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
     * Indicate if is Disabled
     *
     * @return bool
     */
    public function getDisabled()
    {
        return $this->disabled;
    }

    /**
     * Get the E-Mail
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the First Name
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Get the Last Name
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Get the Password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Indicate if will send E-Mail
     *
     * @return bool
     */
    public function getSendEmail()
    {
        return $this->sendEmail;
    }

    /**
     *
     * @param string $name
     * @return Principal Fluent Interface
     */
    public function setName($name)
    {
        $this->name = (string) $name;
        return $this;
    }

    /**
     *
     * @param string $login
     * @return Principal Fluent Interface
     */
    public function setLogin($login)
    {
        $this->login = (string) $login;
        return $this;
    }

    /**
     *
     * @param int $displayUid
     * @return Principal Fluent Interface
     */
    public function setDisplayUid($displayUid)
    {
        $this->displayUid = (int) $displayUid;
        return $this;
    }

    /**
     *
     * @param int $principalId
     * @return Principal Fluent Interface
     */
    public function setPrincipalId($principalId)
    {
        $this->principalId = (int) $principalId;
        return $this;
    }

    /**
     *
     * @param type $isPrimary
     * @return Principal Fluent Interface
     */
    public function setIsPrimary($isPrimary)
    {
        $this->isPrimary = BT::toBoolean($isPrimary);
        return $this;
    }

    /**
     *
     * @param type $type
     * @return Principal Fluent Interface
     * @throws \DomainException
     */
    public function setType($type)
    {
        $this->type = (string) $type;

        if (!in_array(
                $this->type,
                [
                    self::TYPE_ADMINS,
                    self::TYPE_AUTHORS,
                    self::TYPE_COURSE_ADMINS,
                    self::TYPE_EVENT_ADMINS,
                    self::TYPE_EVENT_GROUP,
                    self::TYPE_EVERYONE,
                    self::TYPE_EXTERNAL_GROUP,
                    self::TYPE_EXTERNAL_USER,
                    self::TYPE_GROUP,
                    self::TYPE_GUEST,
                    self::TYPE_LEARNERS,
                    self::TYPE_LIVE_ADMINS,
                    self::TYPE_SEMINAR_ADMINS,
                    self::TYPE_USER,
                ]
        )) {
            throw new \DomainException("{$type} isn't a valid Principal Type");
        }

        return $this;
    }

    /**
     *
     * @param bool $hasChildren
     * @return Principal Fluent Interface
     */
    public function setHasChildren($hasChildren)
    {
        $this->hasChildren = BT::toBoolean($hasChildren);
        return $this;
    }

    /**
     *
     * @param string $permissionId
     * @return Principal Fluent Interface
     */
    public function setPermissionId($permissionId)
    {
        $this->permissionId = (string) $permissionId;
        return $this;
    }

    /**
     *
     * @param int $trainingGroupId
     * @return Principal Fluent Interface
     */
    public function setTrainingGroupId($trainingGroupId)
    {
        $this->trainingGroupId = (int) $trainingGroupId;
        return $this;
    }

    /**
     *
     * @param bool $isEcommerce
     * @return Principal Fluent Interface
     */
    public function setIsEcommerce($isEcommerce)
    {
        $this->isEcommerce = BT::toBoolean($isEcommerce);
        return $this;
    }

    /**
     *
     * @param bool $isHidden
     * @return Principal Fluent Interface
     */
    public function setIsHidden($isHidden)
    {
        $this->isHidden = BT::toBoolean($isHidden);
        return $this;
    }

    /**
     *
     * @param string $description
     * @return Principal Fluent Interface
     */
    public function setDescription($description)
    {
        $this->description = (string) $description;
        return $this;
    }

    /**
     *
     * @param type $accountId
     * @return Principal Fluent Interface
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;
        return $this;
    }

    /**
     *
     * @param bool $disabled
     * @return Principal Fluent Interface
     */
    public function setDisabled($disabled)
    {
        $this->disabled = BT::toBoolean($disabled);
        return $this;
    }

    /**
     *
     * @param string $email
     * @return Principal Fluent Interface
     */
    public function setEmail($email)
    {
        $this->email = (string) $email;
        return $this;
    }

    /**
     *
     * @param string $firstName
     * @return Principal Fluent Interface
     */
    public function setFirstName($firstName)
    {
        $this->firstName = (string) $firstName;
        return $this;
    }

    /**
     *
     * @param string $lastName
     * @return Principal Fluent Interface
     */
    public function setLastName($lastName)
    {
        $this->lastName = (string) $lastName;
        return $this;
    }

    /**
     *
     * @param string $password
     * @return Principal Fluent Interface
     */
    public function setPassword($password)
    {
        $this->password = (string) $password;
        return $this;
    }

    /**
     *
     * @param type $sendEmail
     * @return Principal Fluent Interface
     */
    public function setSendEmail($sendEmail)
    {
        $this->sendEmail = BT::toBoolean($sendEmail);
        return $this;
    }
}
