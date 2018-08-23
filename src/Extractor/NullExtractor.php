<?php

namespace ETL\Extractor;

class NullExtractor implements ExtractorInterface
{
    /**
     * @inheritdoc
     */
    public function extract(): \Traversable
    {
        return new \ArrayIterator();
    }
}
