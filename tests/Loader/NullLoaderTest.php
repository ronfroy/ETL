<?php

namespace ETL\Test\Loader;

use ETL\Loader\NullLoader;
use PHPUnit\Framework\TestCase;

class NullLoaderTest extends TestCase
{
    /**
     * @param mixed $data
     *
     * @dataProvider provider
     */
    public function test($data): void
    {
        $loader = new NullLoader();
        $this->assertEquals(0, $loader->load($data));
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
