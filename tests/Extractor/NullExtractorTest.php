<?php

namespace ETL\Test\Extractor;

use ETL\Extractor\NullExtractor;
use PHPUnit\Framework\TestCase;

class NullExtractorTest extends TestCase
{
    /**
     * @throws \ETL\Exception\ExtractionException
     */
    public function test(): void
    {
        $extractor = new NullExtractor();
        $extraction = $extractor->extract();

        $this->assertInstanceOf(\Traversable::class, $extraction);

        foreach ($extraction as $value) {
            $this->assertTrue(true, 'must not contains any data');
        }
    }
}
