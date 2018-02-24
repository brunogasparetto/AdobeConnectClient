<?php

namespace AdobeConnectClient\Commands;

use \AdobeConnectClient\Command;
use \AdobeConnectClient\Entities\Permission;
use \AdobeConnectClient\Parameter;

/**
 * Set the passcode on a Recording and turned into public.
 *
 * Obs: to set the passcode on a Meeting use the aclFieldUpdate method with the
 * meeting-passcode as the fieldId and the passcode as the value.
 */
class RecordingPasscode extends Command
{
    /**
     * @var int
     */
    protected $scoId;

    /**
     * @var string
     */
    protected $passcode;

    /**
     * @param int $scoId
     * @param string $passcode
     */
    public function __construct($scoId, $passcode)
    {
        $this->scoId = (int) $scoId;
        $this->passcode = (string) $passcode;
    }

    /**
     * @return bool
     */
    protected function process()
    {
        $permission = new Permission();
        $permission->setAclId($this->scoId);
        $permission->setPrincipalId(Permission::RECORDING_PUBLIC);
        $permission->setPermissionId(Permission::MEETING_PRINCIPAL_PUBLIC_ACCESS);
        $this->client->permissionUpdate($permission);

        $parameters = Parameter::instance()
            ->set('isMtgPasscodeReq', true)
            ->set('permissionId', Permission::RECORDING_PUBLIC)
            ->set('principalId', Permission::MEETING_PRINCIPAL_PUBLIC_ACCESS);

        return $this->client->aclFieldUpdate(
            $this->scoId,
            'meetingPasscode',
            $this->passcode,
            $parameters
        );
    }
}
