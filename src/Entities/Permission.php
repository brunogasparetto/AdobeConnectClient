<?php

namespace AdobeConnectClient\Entities;

use \AdobeConnectClient\ArrayableInterface;
use \AdobeConnectClient\Traits\Arrayable;

/**
 * Adobe Connect Permission
 *
 * See {@link https://helpx.adobe.com/adobe-connect/webservices/common-xml-elements-attributes.html#permission_id}
 */
class Permission implements ArrayableInterface
{
    use Arrayable;

    /**
     * Special permission for Meeting
     *
     * This Constant is used in the principal-id parameter with the others MEETING_* constants.
     * @var string
     */
    const MEETING_PRINCIPAL_PUBLIC_ACCESS = 'public-access';

    /**
     * Special permission for Meeting
     *
     * Need set principal-id parameter with Permission::MEETING_PRINCIPAL_PUBLIC_ACCESS
     *
     * The meeting is public, and anyone who has the URL for the meeting can enter the room.
     * @var string
     */
    const MEETING_ANYONE_WITH_URL = 'view-hidden';

    /**
     * Special permission for Meeting
     *
     * Need set principal-id parameter with Permission::MEETING_PRINCIPAL_PUBLIC_ACCESS
     *
     * The meeting is protected and only registered users and accepted guests can enter the room.
     * @var string
     */
    const MEETING_PROTECTED = 'remove';

    /**
     * Special permission for Meeting
     *
     * Need set principal-id parameter with Permission::MEETING_PRINCIPAL_PUBLIC_ACCESS
     *
     * The meeting is private and only registered users and participants can enter the room.
     * @var string
     */
    const MEETING_PRIVATE = 'denied';

    /**
     * Special permission for Recording
     *
     * The recording is public.
     * @var string
     */
    const RECORDING_PUBLIC = 'view';

    /**
     * The principal can view, but cannot modify, the SCO.
     * The principal can take a course, attend a meeting as participant, or view a folder’s content.
     * @var string
     */
    const PRINCIPAL_VIEW = 'view';

    /**
     * Available for meetings only.
     *
     * The principal is host of a meeting and can create the meeting or act as presenter,
     * even without view permission on the meeting’s parent folder.
     * @var string
     */
    const PRINCIPAL_HOST = 'host';

    /**
     * Available for meetings only.
     *
     * The principal is presenter of a meeting and can present content, share a screen,
     * send text messages, moderate questions, create text notes, broadcast audio and video,
     * and push content from web links.
     * @var string
     */
    const PRINCIPAL_MINI_HOST = 'mini-host';

    /**
     * Available for meetings only.
     *
     * The principal does not have participant, presenter or host permission to attend the meeting.
     * If a user is already attending a live meeting, the user is not removed from the meeting until
     * the session times out.
     * @var string
     */
    const PRINCIPAL_REMOVE = 'remove';

    /**
     * Available for SCOs other than meetings.
     *
     * The principal can publish or update the SCO.
     * The publish permission includes view and allows the principal to view reports related to the SCO.
     * On a folder, publish does not allow the principal to create new subfolders or set permissions.
     * @var string
     */
    const PRINCIPAL_PUBLISH = 'publish';

    /**
     * Available for SCOs other than meetings or courses.
     *
     * The principal can view, delete, move, edit, or set permissions on the SCO.
     * On a folder, the principal can create subfolders or view reports on folder content.
     * @var string
     */
    const PRINCIPAL_MANAGE = 'manage';

    /**
     * Available for SCOs other than meetings.
     *
     * The principal cannot view, access, or manage the SCO.
     * @var string
     */
    const PRINCIPAL_DENIED = 'denied';

    /**
     * ACL (Access Control List) ID. Usually a SCO ID or Principal ID.
     * @var int
     */
    protected $aclId = null;

    /**
     * @var string
     */
    protected $permissionId = null;

    /**
     * Normally is int, but in special cases is string using the MEETING_* constants
     *
     * @var int|string
     */
    protected $principalId = null;

    /**
     * Returns a new Permission instance
     *
     * @return Permission
     */
    public static function instance()
    {
        return new static;
    }

    /**
     * Get the ACL ID.
     *
     * ACL (Access Control List) ID. Usually a SCO ID or Principal ID.
     *
     * @return int
     */
    public function getAclId()
    {
        return $this->aclId;
    }

    /**
     * Get the Permission ID.
     *
     * @see PRINCIPAL_* constants
     *
     * @return string
     */
    public function getPermissionId()
    {
        return $this->permissionId;
    }

    /**
     * The Principal ID or Special Permission using MEETING_* constants
     *
     * @return int|string
     */
    public function getPrincipalId()
    {
        return $this->principalId;
    }

    /**
     * Set the ACL ID. It is a SCO ID or Principal ID.
     *
     * @param int $aclId
     * @return Permission
     */
    public function setAclId($aclId)
    {
        $this->aclId = $aclId;
        return $this;
    }

    /**
     * The Permission ID.
     *
     * @see PRINCIPAL_* constants
     *
     * @param string $permissionId
     * @return Permission
     */
    public function setPermissionId($permissionId)
    {
        $this->permissionId = $permissionId;
        return $this;
    }

    /**
     * Set the Principal ID.
     *
     * If setting a Meeting this can be a special permission using MEETING_* constants
     *
     * @param int|string $principalId
     * @return Permission
     */
    public function setPrincipalId($principalId)
    {
        $this->principalId = $principalId;
        return $this;
    }
}
