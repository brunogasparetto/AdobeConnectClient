<?php
declare(strict_types=1);

namespace AdobeConnectClient\Commands;

use AdobeConnectClient\Command;
use AdobeConnectClient\ArrayableInterface;
use AdobeConnectClient\Converter\Converter;
use AdobeConnectClient\Entities\Principal;
use AdobeConnectClient\Helpers\StatusValidate;
use AdobeConnectClient\Helpers\SetEntityAttributes as FillObject;

/**
 * Get a list of principals who have permissions to act on a SCO, Principal or Account
 *
 * More info see {@link https://helpx.adobe.com/adobe-connect/webservices/permissions-info.html}
 */
class PermissionsInfo extends Command
{
    /**
     * @var array
     */
    protected $parameters;

    /**
     * @param int $aclId SCO ID, Principal ID or Account ID
     * @param ArrayableInterface|null $filter
     * @param ArrayableInterface|null $sorter
     */
    public function __construct(
        int $aclId,
        ?ArrayableInterface $filter = null,
        ?ArrayableInterface $sorter = null
    ) {
        $this->parameters = [
            'action' => 'permissions-info',
            'acl-id' => $aclId,
        ];

        if ($filter) {
            $this->parameters += $filter->toArray();
        }

        if ($sorter) {
            $this->parameters += $sorter->toArray();
        }
    }

    /**
     * @inheritdoc
     *
     * @return Principal[]
     */
    protected function process(): array
    {
        $response = Converter::convert(
            $this->client->doGet(
                $this->parameters + ['session' => $this->client->getSession()]
            )
        );
        StatusValidate::validate($response['status']);

        $principals = [];

        foreach ($response['permissions'] as $principalAttributes) {
            $principal = new Principal();
            FillObject::setAttributes($principal, $principalAttributes);
            $principals[] = $principal;
        }
        return $principals;
    }
}
