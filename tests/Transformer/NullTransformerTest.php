<?php

namespace ETL\Test\Extractor;

use ETL\Transformer\NullTransformer;
use PHPUnit\Framework\TestCase;

class NullTransformerTest extends TestCase
{
    /**
     * @param mixed $data
     *
     * @dataProvider provider
     */
    public function test($data): void
    {
        $transformer = new NullTransformer();
        $this->assertEquals($data, $transformer->transform($data));
    }


    /**
     * @return array
     */
    public function provider(): array
    {
        return [
            [ 'test' ],
            [ 1 ],
            [ new \stdClass() ],
        ];
    }
}
