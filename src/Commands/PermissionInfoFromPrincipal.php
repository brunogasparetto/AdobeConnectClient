<?php
declare(strict_types=1);

namespace AdobeConnectClient\Commands;

use AdobeConnectClient\Command;
use AdobeConnectClient\Entities\Permission;
use AdobeConnectClient\Converter\Converter;
use AdobeConnectClient\Helpers\StatusValidate;
use AdobeConnectClient\Helpers\SetEntityAttributes as FillObject;

/**
 * Get the Principal's permission in a SCO, Principal or Account
 *
 * More info see {@link https://helpx.adobe.com/adobe-connect/webservices/permissions-info.html}
 */
class PermissionInfoFromPrincipal extends Command
{
    /**
     * @var int
     */
    protected $aclId;

    /**
     * @var int
     */
    protected $principalId;

    /**
     * @param int $aclId
     * @param int $principalId
     */
    public function __construct(int $aclId, int $principalId)
    {
        $this->aclId = $aclId;
        $this->principalId = $principalId;
    }

    /**
     * @inheritdoc
     *
     * @return Permission
     */
    protected function process(): Permission
    {
        $response = Converter::convert(
            $this->client->doGet([
                'action' => 'permissions-info',
                'acl-id' => $this->aclId,
                'principal-id' => $this->principalId,
                'session' => $this->client->getSession()
            ])
        );
        StatusValidate::validate($response['status']);
        $permission = new Permission();
        FillObject::setAttributes($permission, $response['permission']);
        return $permission;
    }
}
