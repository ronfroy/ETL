<?php

namespace ETL\Test\Loader;

use ETL\Loader\LoaderChain;
use ETL\Loader\LoaderInterface;
use PHPUnit\Framework\TestCase;

class LoaderChainTest extends TestCase
{
    /**
     * @param LoaderInterface[] $loaders
     * @param int $expected
     *
     * @dataProvider provider
     */
    public function test($loaders, int $expected): void
    {
        $loader = new LoaderChain($loaders);
        $this->assertEquals($expected, $loader->load([]));
    }


    /**
     * @return array
     */
    public function provider(): array
    {
        return [
            'without loader' => [ [], 0],
            'with only one loader' => [ [$this->loaderFactory(5)], 5],
            'with many loaders' => [
                [
                    $this->loaderFactory(5),
                    $this->loaderFactory(0),
                    $this->loaderFactory(10),
                ],
                15
            ],

        ];
    }

    /**
     * @param int $count
     *
     * @return LoaderInterface
     */
    private function loaderFactory(int $count): LoaderInterface
    {
        $loader = $this->createMock(LoaderInterface::class);
        $loader->method('load')->willReturn($count);
        /** @var LoaderInterface $loader */

        return $loader;
    }
}
