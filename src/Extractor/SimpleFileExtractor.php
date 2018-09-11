<?php

namespace ETL\Extractor;

use ETL\Exception\ExtractionException;

class SimpleFileExtractor implements ExtractorInterface
{
    /** @var string[] */
    private $pathList = [];

    /**
     * SimpleFileExtractor constructor.
     *
     * @param string[] $pathList file path list
     */
    public function __construct(array $pathList)
    {
        foreach ($pathList as $filePath) {
            $this->addFilePath($filePath);
        }
    }

    /**
     * @inheritdoc
     */
    public function extract(): \Traversable
    {
        $generator = function () {
            foreach ($this->pathList as $filePath) {
                $content = @file_get_contents($filePath);

                if (false === $content) {
                    throw ExtractionException::canNotRetrieveDataFromTheFile($filePath);
                }

                yield $content;
            }
        };

        return $generator();
    }

    /**
     * @param string $filePath
     */
    private function addFilePath(string $filePath)
    {
        $this->pathList[] = $filePath;
    }
}
