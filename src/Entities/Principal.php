<?php

namespace AdobeConnectClient\Entities;

use DomainException;
use AdobeConnectClient\ArrayableInterface;
use AdobeConnectClient\Helpers\ValueTransform as VT;
use AdobeConnectClient\Helpers\StringCaseTransform as SCT;

/**
 * Adobe Connect Principal
 *
 * See {@link https://helpx.adobe.com/adobe-connect/webservices/common-xml-elements-attributes.html#type}
 *
 * @todo Maybe a factory for the differents types?
 */
class Principal implements ArrayableInterface
{
    /**
     * The built-in group Administrators, for Adobe Connect server Administrators.
     * @var string
     */
    const TYPE_ADMINS = 'admins';

    /**
     * The built-in group Administrators, for Adobe Connect server Administrators.
     * @var string
     */
    const TYPE_ADMINS_LIMITED = 'admins-limited';

    /**
     * The built-in group Authors, for authors.
     * @var string
     */
    const TYPE_AUTHORS = 'authors';

    /**
     * The built-in group Training Managers, for training managers.
     * @var string
     */
    const TYPE_COURSE_ADMINS = 'course-admins';

    /**
     * The built-in group Event Managers, for anyone who can create an Adobe Connect meeting.
     * @var string
     */
    const TYPE_EVENT_ADMINS = 'event-admins';

    /**
     * The group of users invited to an event.
     * @var string
     */
    const TYPE_EVENT_GROUP = 'event-group';

    /**
     * All Adobe Connect users.
     * @var string
     */
    const TYPE_EVERYONE = 'everyone';

    /**
     * A group authenticated from an external network.
     * @var string
     */
    const TYPE_EXTERNAL_GROUP = 'external-group';

    /**
     * A user authenticated from an external network.
     * @var string
     */
    const TYPE_EXTERNAL_USER = 'external-user';

    /**
     * A group that a user or Administrator creates.
     * @var string
     */
    const TYPE_GROUP = 'group';

    /**
     * A non-registered user who enters an Adobe Connect meeting room.
     * @var string
     */
    const TYPE_GUEST = 'guest';

    /**
     * The built-in group learners, for users who take courses.
     * @var string
     */
    const TYPE_LEARNERS = 'learners';

    /**
     * The built-in group Meeting Hosts, for Adobe Connect meeting hosts.
     * @var string
     */
    const TYPE_LIVE_ADMINS = 'live-admins';

    /**
     * The built-in group Seminar Hosts, for seminar hosts.
     * @var string
     */
    const TYPE_SEMINAR_ADMINS = 'seminar-admins';

    /**
     * A registered user on the server.
     * @var string
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
     * @see Permission::PRINCIPAL_* constants
     *
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
     *
     * @var bool
     */
    protected $sendEmail = null;

    /**
     * Indicates if the user is a member of the group (@see \AdobeConnectClient\Commands\PrincipalList)
     *
     * @var bool
     */
    protected $isMember = null;

    /**
     * The fields for create/update a User
     *
     * @return string[]
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
     * @return string[]
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
     * Returns a new Principal instance
     *
     * @return Principal
     */
    public static function instance()
    {
        return new static();
    }

    /**
     * Retrieves all not null attributes in an associative array
     *
     * @todo Returns fields for all types
     *
     * @return string[] [string => string]
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
                $parameters[SCT::toHyphen($field)] = VT::toString($value);
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
     * More info about types see
     * {@link https://helpx.adobe.com/adobe-connect/webservices/common-xml-elements-attributes.html#type}
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
     * @see \AdobeConnectClient\Entities\Permission
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
     * @return Principal
     */
    public function setName($name)
    {
        $this->name = (string) $name;
        $this->fixNameByType();
        return $this;
    }

    /**
     *
     * @param string $login
     * @return Principal
     */
    public function setLogin($login)
    {
        $this->login = (string) $login;
        return $this;
    }

    /**
     *
     * @param int $displayUid
     * @return Principal
     */
    public function setDisplayUid($displayUid)
    {
        $this->displayUid = $displayUid;
        return $this;
    }

    /**
     *
     * @param int $principalId
     * @return Principal
     */
    public function setPrincipalId($principalId)
    {
        $this->principalId = $principalId;
        return $this;
    }

    /**
     *
     * @param bool $isPrimary
     * @return Principal
     */
    public function setIsPrimary($isPrimary)
    {
        $this->isPrimary = VT::toBool($isPrimary);
        return $this;
    }

    /**
     * Set the Principal type.
     *
     * More info about types see
     * {@link https://helpx.adobe.com/adobe-connect/webservices/common-xml-elements-attributes.html#type}
     *
     * @param string $type
     * @return Principal
     * @throws DomainException
     */
    public function setType($type)
    {
        $this->type = (string) $type;

        if (!in_array(
            $this->type,
            [
                self::TYPE_ADMINS,
                self::TYPE_ADMINS_LIMITED,
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
            throw new DomainException("{$type} isn't a valid Principal Type");
        }

        $this->fixNameByType();

        return $this;
    }

    /**
     * Fix the name or firstName and lastName.
     *
     * The user type has firstName and lastName, but some actions from Adobe Connect returns the
     * Principal user type with name, so we need fix it.
     */
    protected function fixNameByType()
    {
        if ($this->type === self::TYPE_GROUP and empty($this->name) and $this->firstName and $this->lastName) {
            $this->name = $this->firstName . ' ' . $this->lastName;
            return;
        }

        if ($this->type === self::TYPE_USER and empty($this->firstName) and empty($this->lastName) and $this->name) {
            $names = explode(' ', $this->name, 2);

            if (count($names) !== 2) {
                $this->firstName = $names[0];
                return;
            }

            list($this->firstName, $this->lastName) = $names;
        }
    }

    /**
     *
     * @param bool $hasChildren
     * @return Principal
     */
    public function setHasChildren($hasChildren)
    {
        $this->hasChildren = VT::toBool($hasChildren);
        return $this;
    }

    /**
     *
     * @see \AdobeConnectClient\Entities\Permission
     * @param string $permissionId
     * @return Principal
     */
    public function setPermissionId($permissionId)
    {
        $this->permissionId = (string) $permissionId;
        return $this;
    }

    /**
     *
     * @param int $trainingGroupId
     * @return Principal
     */
    public function setTrainingGroupId($trainingGroupId)
    {
        $this->trainingGroupId = $trainingGroupId;
        return $this;
    }

    /**
     *
     * @param bool $isEcommerce
     * @return Principal
     */
    public function setIsEcommerce($isEcommerce)
    {
        $this->isEcommerce = VT::toBool($isEcommerce);
        return $this;
    }

    /**
     *
     * @param bool $isHidden
     * @return Principal
     */
    public function setIsHidden($isHidden)
    {
        $this->isHidden = VT::toBool($isHidden);
        return $this;
    }

    /**
     *
     * @param string $description
     * @return Principal
     */
    public function setDescription($description)
    {
        $this->description = (string) $description;
        return $this;
    }

    /**
     *
     * @param int $accountId
     * @return Principal
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;
        return $this;
    }

    /**
     *
     * @param bool $disabled
     * @return Principal
     */
    public function setDisabled($disabled)
    {
        $this->disabled = VT::toBool($disabled);
        return $this;
    }

    /**
     *
     * @param string $email
     * @return Principal
     */
    public function setEmail($email)
    {
        $this->email = (string) $email;
        return $this;
    }

    /**
     *
     * @param string $firstName
     * @return Principal
     */
    public function setFirstName($firstName)
    {
        $this->firstName = (string) $firstName;
        $this->fixNameByType();
        return $this;
    }

    /**
     *
     * @param string $lastName
     * @return Principal
     */
    public function setLastName($lastName)
    {
        $this->lastName = (string) $lastName;
        $this->fixNameByType();
        return $this;
    }

    /**
     *
     * @param string $password
     * @return Principal
     */
    public function setPassword($password)
    {
        $this->password = (string) $password;
        return $this;
    }

    /**
     *
     * @param bool $sendEmail
     * @return Principal
     */
    public function setSendEmail($sendEmail)
    {
        $this->sendEmail = VT::toBool($sendEmail);
        return $this;
    }

    /**
     * @return bool
     */
    public function getIsMember()
    {
        return $this->isMember;
    }

    /**
     * @param bool $isMember
     */
    public function setIsMember($isMember)
    {
        $this->isMember = VT::toBool($isMember);
    }
}
