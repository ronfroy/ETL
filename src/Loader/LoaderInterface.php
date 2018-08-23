<?php

declare(strict_types=1);

namespace ETL\Loader;

interface LoaderInterface
{
    /**
     * @param mixed $data
     *
     * @return int number of item loaded
     */
    public function load($data): int;
}
