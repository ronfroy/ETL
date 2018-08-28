<?php

namespace ETL\Extractor;

use ETL\Exception\ExtractionException;

class SimpleFileExtractor implements ExtractorInterface
{
    /** @var string */
    private $filePath;

    /**
     * SimpleFileExtractor constructor.
     *
     * @param string $filePath
     */
    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * @inheritdoc
     */
    public function extract(): \Traversable
    {
        $content = @file_get_contents($this->filePath);

        if (false === $content) {
            throw ExtractionException::canNotRetrieveDataFromTheFile($this->filePath);
        }

        return new \ArrayIterator([$content]);
    }
}
