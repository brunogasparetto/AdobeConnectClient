<?php
namespace Bruno\AdobeConnectClient\Connection;

/**
 * The Connection using cURL
 */
class CurlConnection implements ConnectionInterface
{
    /**
     * @var array Associative array of Options. Option => Value
     */
    private $config = [];

    /**
     * @var string $host The host URL
     */
    protected $host = '';

    /**
     * Construct
     *
     * @param string $host The Host URL
     * @param array $config An array to config the Connection
     */
    public function __construct($host, array $config = [])
    {
        $this->setHost($host);
        $this->setConfig($config);
    }

    /**
     * Set the Host URL
     *
     * @param string $host The Host URL
     */
    public function setHost($host)
    {
        $host = filter_var(rtrim($host, " /\n\t"), FILTER_SANITIZE_URL);

        if (!filter_var($host, FILTER_VALIDATE_URL, FILTER_FLAG_SCHEME_REQUIRED)) {
            throw new \InvalidArgumentException('Connection Host must be a valid URL with scheme');
        }
        $this->host = strpos($host, '/api/xml') === false ? $host . '/api/xml' : $host;
    }

    /**
     * Send a GET request
     *
     * @param array $queryParams Additional parameters to add in URL. fieldName => value
     * @return Response
     */
    public function get(array $queryParams = [])
    {

        $headers = [];

        $ch = curl_init($this->getFullURL($queryParams));
        curl_setopt_array($ch, $this->config);
        curl_setopt($ch, CURLOPT_HEADERFUNCTION, function ($curlResource, $headerLine) use (&$headers)
            {
                $pos = strpos($headerLine, ':');

                if ($pos !== false) {
                    $headers[trim(substr($headerLine, 0, $pos))] = trim(substr($headerLine, $pos + 1));
                }
                return strlen($headerLine);
            }
        );
        $body = new Stream(curl_exec($ch));
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return new Response($statusCode, $headers, $body);
    }

    /**
     * Send a POST request
     *
     * The request need be send as application/x-www-form-urlencoded or multipart/form-data.
     * To send files need pass as stream file or SplFileInfo in $postParams
     *
     * @param array $postParams The post parameters. fieldName => value
     * @param array $queryParams Additional parameters to add in URL. fieldName => value
     * @return Response
     */
    public function post(array $postParams, array $queryParams = [])
    {
        $headers = [];

        $ch = curl_init($this->getFullURL($queryParams));
        curl_setopt_array($ch, $this->config);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->convertFileParams($postParams));
        curl_setopt($ch, CURLOPT_HEADERFUNCTION, function ($curlResource, $headerLine) use (&$headers)
            {
                $pos = strpos($headerLine, ':');

                if ($pos !== false) {
                    $headers[trim(substr($headerLine, 0, $pos))] = trim(substr($headerLine, $pos + 1));
                }
                return strlen($headerLine);
            }
        );
        $body = new Stream(curl_exec($ch));
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return new Response($statusCode, $headers, $body);
    }

    /**
     * Get the full URL with query parameters
     *
     * @param string $queryParams
     * @return string
     */
    private function getFullURL(array $queryParams)
    {
        return $this->host . (empty($queryParams) ? '' : '?' . http_build_query($queryParams));
    }

    /**
     * Convert stream file and \SplFileInfo in \CurlFile
     *
     * @param array $params Parameters as FieldName => Value
     * @return array
     */
    private function convertFileParams($params)
    {
        foreach ($params as $param => $value) {
            $fileInfo = $this->fileInfo($value);

            if ($fileInfo) {
                $params[$param] = new \CurlFile($fileInfo->path, $fileInfo->mime);
            }
        }
        return $params;
    }

    /**
     * Get the filepath and mime-type from a file.
     *
     * If it's a stream file or \SplFileInfo object returns an object with path and mime.
     *
     * @param mixed $item A stream file or \SplFileInfo object
     * @return stdClass|null Returns null if it's not a valid stream file or \SplFileInfo
     */
    private function fileInfo($item)
    {
        if (is_resource($item)) {
            $streamMeta = stream_get_meta_data($item);

            if ($streamMeta['wrapper_type'] !== 'plainfile') {
                return null;
            }
            $path = $streamMeta['uri'];
            $mime = mime_content_type($path);

        } elseif ($item instanceof \SplFileInfo and $item->getType() === 'file') {
            $path = $item->getPathname();
            $mime = mime_content_type($path);

        } else {
            return null;
        }

        $info = new stdClass;
        $info->path = $path;
        $info->mime = $mime;

        return $info;
    }

    /**
     * Set the cURL config
     *
     * @param array $config Items as Option => Value
     */
    private function setConfig(array $config)
    {
        $defaults = [
            CURLOPT_CONNECTTIMEOUT => 120,
            CURLOPT_TIMEOUT => 120,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_SSL_VERIFYHOST => 2,
        ];
        $this->config = $config + $defaults;

        // Always need this configurations
        $this->config[CURLOPT_RETURNTRANSFER] = true;
        $this->config[CURLOPT_FOLLOWLOCATION] = true;
    }
}