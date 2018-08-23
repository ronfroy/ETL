<?php

namespace ETL\Loader;

class NullLoader implements LoaderInterface
{
    /**
     * @inheritdoc
     */
    public function load($data): int
    {
        return 0;
    }
}
