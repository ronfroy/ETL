<?php

declare(strict_types=1);

namespace ETL\Exception;

class ExtractionException extends \Exception implements ExceptionInterface
{
    /**
     * @param string $filePath
     *
     * @return ExtractionException
     */
    final public static function canNotRetrieveDataFromTheFile(string $filePath): ExtractionException
    {
        return new self(sprintf('Can not retrieve data from the file `%s`', $filePath));
    }
}
