<?php

declare(strict_types=1);

namespace ETL\Exception;

use App\ETL\Exception\ETLExceptionInterface;

class JobException extends \Exception implements ETLExceptionInterface
{
    /**
     * @param int        $increment
     * @param \Throwable $throwable
     *
     * @return JobException
     */
    final public static function batchFailed(int $increment, ?\Throwable $throwable = null): JobException
    {
        return new self(sprintf('Batch (%s) failed ', $increment), 0, $throwable);
    }

    /**
     * @param \Throwable $throwable
     *
     * @return JobException
     */
    final public static function jobFailed(?\Throwable $throwable = null): JobException
    {
        return new self('Job failed', 0, $throwable);
    }
}
