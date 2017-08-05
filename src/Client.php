<?php

namespace AdobeConnectClient;

use ReflectionClass;
use AdobeConnectClient\Connection\ConnectionInterface;

/**
 * Manage the commands service and the session.
 *
 * All Commands are in Commands folder and extends CommandAbstract.
 *
 * @method bool login(string $login, string $password) Login in the Service.
 * @method bool logout() Ends the service session
 * @method CommonInfo commonInfo() Gets the Common Info
 * @method SCO scoInfo(int $scoId) Gets the info about a SCO
 * @method SCO scoCreate(ParameterInterface $sco) Create a SCO
 * @method bool scoUpdate(ParameterInterface $sco) Update a SCO
 * @method bool scoDelete(int $scoId) Delete a SCO or a Folder
 * @method bool scoMove(int $scoId, int $folderId) Move the SCO to other Folder
 * @method SCO[] scoContents(int $scoId, ParameterInterface $filter = null, ParameterInterface $sorter = null) Get the SCO Contents from a folder or from other SCO
 * @method SCORecord[] listRecordings(int $folderId) Provides a list of recordings for a specified folder or SCO
 * @method Principal principalInfo(int $principalId) Gets the info about an user or group
 * @method Principal principalCreate(ParameterInterface $principal) Create a Principal.
 * @method bool principalUpdate(ParameterInterface $principal) Update a Principal.
 * @method bool principalDelete(int $principalId) Remove one principal, either user or group
 * @method Principal[] principalList(int $groupId = 0, ParameterInterface $filter = null, ParameterInterface $sorter = null) Provides a complete list of users and groups, including primary groups.
 * @method bool userUpdatePassword(int $userId, string $newPassword, string $oldPassword = '') Changes user’s password
 * @method bool groupMembershipUpdate(int $groupId, int $principalId, bool $isMember) Add or remove a principal from a group
 * @method bool permissionUpdate(ParameterInterface $permission) Updates the principal's permissions to access a SCO or the access mode if the acl-id is a Meeting
 * @method Permission[] permissionsInfo(int $aclId, ParameterInterface $filter, ParameterInterface $sorter) Get a list of principals who have permissions to act on a SCO, Principal or Account
 * @method Permission permissionInfoFromPrincipal(int $aclId, int $principalId) Get the Principal's permission in a SCO, Principal or Account
 * @method bool meetingFeatureUpdate(int $accountId, string $featureId, bool $enable) Set a feature
 * @method bool aclFieldUpdate(int $aclId, string $fieldId, mixed $value, ParameterInterface $extraParams = null) Updates the passed in Field for the specified ACL
 * @method bool recordingPasscode(int $scoId, string $passcode) Set the passcode on a Recording and turned into public
 * @method bool scoUpload(int $folderId, string $resourceName, resource|SplFileInfo $file) Uploads a file and then builds the file
 */
class Client
{
    /** @var ConnectionInterface */
    protected $connection;

    /** @var string The Session Cookie */
    protected $sessionCookie = '';

    /**
     * @param ConnectionInterface $connection The Connection handler
     */
    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return ConnectionInterface
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * @return string
     */
    public function getSession()
    {
        return $this->sessionCookie;
    }

    /**
     * @param string $session
     */
    public function setSession($session = '')
    {
        $this->sessionCookie = $session;
    }

    /**
     * Instantiates the Command and execute it.
     *
     * @param string $commandName
     * @param array $arguments
     * @return mixed
     */
    public function __call($commandName, array $arguments = [])
    {
        $className = 'AdobeConnectClient\\Commands\\' . $commandName;

        if (!class_exists($className)) {
            throw new \BadMethodCallException(sprintf('"%s" is not defined as command', $commandName));
        }

        $reflection = new ReflectionClass($className);

        if (!$reflection->isSubclassOf(Command::class)) {
            throw new \DomainException(sprintf('"%s" is not a valid command', $className));
        }
        array_unshift($arguments, $this);
        return $reflection->newInstanceArgs($arguments)->execute();
    }
}
