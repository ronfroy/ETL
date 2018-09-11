<?php

namespace ETL\Test\Extractor;

use ETL\Exception\ExtractionException;
use ETL\Extractor\SimpleFileExtractor;
use PHPUnit\Framework\TestCase;

class SimpleFileExtractorTest extends TestCase
{
    /**
     * @throws ExtractionException
     */
    public function test(): void
    {
        $fileName = tempnam(sys_get_temp_dir(), 'ETL');

        $extractor = new SimpleFileExtractor([$fileName, $fileName]);

        file_put_contents($fileName, 1);

        try {
            $extraction = $extractor->extract();

            foreach ($extraction as $data) {
                $this->assertEquals(1, $data);
            }
        } finally {
            unlink($fileName);
        }

        $this->expectException(ExtractionException::class);

        $extraction = $extractor->extract();

        foreach ($extraction as $data) {
            $this->assertEquals(1, $data);
        }
    }
}
