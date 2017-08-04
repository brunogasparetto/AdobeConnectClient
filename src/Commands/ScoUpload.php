<?php

namespace AdobeConnectClient\Commands;

use SplFileInfo;
use AdobeConnectClient\Commands\CommandAbstract;
use AdobeConnectClient\Client;
use AdobeConnectClient\Filter;
use AdobeConnectClient\SCO;
use AdobeConnectClient\Converter\Converter;
use AdobeConnectClient\Helpers\StatusValidate;
use AdobeConnectClient\Exceptions\NoDataException;

/**
 * Uploads a file to the server and then builds the file, if necessary.
 *
 * Create a new File SCO or update if exists in the folder (a SCO Meeting) and upload the file.
 *
 * @see https://helpx.adobe.com/adobe-connect/webservices/sco-upload.html
 *
 * Important: the filename (filePath) needs the extension for Adobe Connect purpose.
 */
class ScoUpload extends CommandAbstract
{
    /** @var int */
    protected $folderId;

    /** @var string */
    protected $resourceName;

    /** @var resource|SplFileInfo */
    protected $file;

    /**
     *
     * @param Client $client
     * @param int $folderId The Folder (SCO ID) owned the file
     * @param type $resourceName
     * @param SplFileInfo $file
     * @throws \InvalidArgumentException
     */
    public function __construct(Client $client, $folderId, $resourceName, $file)
    {
        if (!is_resource($file) && !($file instanceof SplFileInfo)) {
            throw new \InvalidArgumentException('File need be a valid resource or a SplFileInfo object');
        }

        parent::__construct($client);
        $this->folderId = (int) $folderId;
        $this->resourceName = (string) $resourceName;
        $this->file = $file;
    }

    /**
     * @return bool
     */
    public function execute()
    {
        $sco = $this->getSco();

        $responseConverted = Converter::convert(
            $this->client->getConnection()->post(
                [
                    'file' => $this->file
                ],
                [
                    'action' => 'sco-upload',
                    'sco-id' => $sco->getScoId(),
                    'session' => $this->client->getSession()
                ]
            )
        );
        StatusValidate::validate($responseConverted['status']);
        return true;
    }

    /**
     * Get the SCO if exists or create a new SCO
     *
     * @return SCO
     */
    protected function getSco()
    {
        $filter = Filter::instance()
            ->equals('folderId', $this->folderId)
            ->equals('name', $this->resourceName)
            ->equals('type', SCO::TYPE_CONTENT);

        try {
            $scos = $this->client->scoContents($this->folderId, $filter);
            return reset($scos);
        } catch (NoDataException $ex) {
            $sco = SCO::instance()
                ->setType(SCO::TYPE_CONTENT)
                ->setFolderId($this->folderId)
                ->setName($this->resourceName);

            return $this->client->scoCreate($sco);
        }
    }
}
