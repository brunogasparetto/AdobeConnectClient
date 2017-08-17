<?php

namespace AdobeConnectClient\Commands;

use SplFileInfo;
use InvalidArgumentException;
use AdobeConnectClient\Command;
use AdobeConnectClient\Filter;
use AdobeConnectClient\SCO;
use AdobeConnectClient\Converter\Converter;
use AdobeConnectClient\Helpers\StatusValidate;

/**
 * Uploads a file to the server and then builds the file, if necessary.
 *
 * Create a new File SCO or update if exists in the folder (a SCO Meeting) and upload the file.
 *
 * @link https://helpx.adobe.com/adobe-connect/webservices/sco-upload.html
 *
 * Important: the filename (filePath) needs the extension for Adobe Connect purpose.
 */
class ScoUpload extends Command
{
    /** @var int */
    protected $folderId;

    /** @var string */
    protected $resourceName;

    /** @var resource|SplFileInfo */
    protected $file;

    /**
     *
     * @param int $folderId The Folder (SCO ID) owned the file
     * @param string $resourceName
     * @param SplFileInfo $file
     * @throws InvalidArgumentException
     */
    public function __construct($folderId, $resourceName, $file)
    {
        if (!is_resource($file) && !($file instanceof SplFileInfo)) {
            throw new InvalidArgumentException('File need be a valid resource or a SplFileInfo object');
        }
        $this->folderId = (int) $folderId;
        $this->resourceName = (string) $resourceName;
        $this->file = $file;
    }

    /**
     * @return bool
     */
    protected function process()
    {
        $response = Converter::convert(
            $this->client->doPost(
                [
                    'file' => $this->file
                ],
                [
                    'action' => 'sco-upload',
                    'sco-id' => $this->getSco()->getScoId(),
                    'session' => $this->client->getSession()
                ]
            )
        );
        StatusValidate::validate($response['status']);
        return true;
    }

    /**
     * Get the SCO content if exists or create one
     *
     * @return SCO
     */
    protected function getSco()
    {
        $scos = $this->client->scoContents(
            $this->folderId,
            Filter::instance()
                ->equals('folderId', $this->folderId)
                ->equals('name', $this->resourceName)
                ->equals('type', SCO::TYPE_CONTENT)
        );
        return empty($scos) ? $this->createSco() : reset($scos);
    }

    /**
     * Create a SCO content
     *
     * @return SCO
     */
    protected function createSco()
    {
        return $this->client->scoCreate(
            SCO::instance()
                ->setType(SCO::TYPE_CONTENT)
                ->setFolderId($this->folderId)
                ->setName($this->resourceName)
        );
    }
}
