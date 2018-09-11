<?php

declare(strict_types=1);

namespace Tests\ETL\Exception;

use ETL\Exception\ExtractionException;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \ETL\Exception\ExtractionException
 */
class ExtractionExceptionTest extends TestCase
{
    /**
     * @covers ::canNotRetrieveDataFromTheFile
     */
    public function testBatchFailed(): void
    {
        $this->assertInstanceOf(ExtractionException::class, ExtractionException::canNotRetrieveDataFromTheFile('filename'));
    }
}
