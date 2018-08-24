<?php

declare(strict_types=1);

namespace ETL\Extractor;

use ETL\Exception\ExtractionException;

interface ExtractorInterface
{
    /**
     * @return \Iterator
     *
     * @throws ExtractionException
     */
    public function extract(): \Traversable;
}
