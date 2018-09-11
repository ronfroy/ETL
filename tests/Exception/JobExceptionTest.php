<?php

declare(strict_types=1);

namespace Tests\ETL\Exception;

use ETL\Exception\JobException;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \ETL\Exception\JobException
 */
class JobExceptionTest extends TestCase
{
    /**
     * @covers ::batchFailed
     */
    public function testBatchFailed(): void
    {
        $this->assertInstanceOf(JobException::class, JobException::batchFailed(1));
        $this->assertInstanceOf(JobException::class, JobException::batchFailed(1, new \Exception()));
    }

    /**
     * @covers ::jobFailed
     */
    public function testJobFailed(): void
    {
        $this->assertInstanceOf(JobException::class, JobException::jobFailed());
        $this->assertInstanceOf(JobException::class, JobException::jobFailed(new \Exception()));
    }
}
