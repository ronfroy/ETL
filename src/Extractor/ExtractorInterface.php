<?php

declare(strict_types=1);

namespace ETL\Extractor;

interface ExtractorInterface
{
    /**
     * @return \Iterator
     */
    public function extract(): \Traversable;
}
