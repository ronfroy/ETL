<?php

namespace ETL\Test\Extractor;

use ETL\Transformer\TransformerChain;
use ETL\Transformer\TransformerInterface;
use PHPUnit\Framework\TestCase;

class TransformerChainTest extends TestCase
{
    /**
     * @param $transformers
     * @param $input
     * @param $expected
     *
     * @dataProvider provider
     */
    public function test($transformers, $input, $expected): void
    {
        $transformer = new TransformerChain($transformers);
        $this->assertEquals($expected, $transformer->transform($input));
    }

    /**
     * @return array
     */
    public function provider(): array
    {
        return [
            'without transformer' => [[], 5, 5],
            'with only one transformer' => [[ $this->transformerFactory(1, 123.45) ], 1, 123.45 ],
            'with many transformer' => [
                [
                    $this->transformerFactory(1, ''),
                    $this->transformerFactory('', []),
                    $this->transformerFactory([], 2),
                ],
                1,
                2
            ],

        ];
    }

    /**
     * @param mixed $input expected input
     * @param mixed $output transformer output
     *
     * @return TransformerInterface
     */
    private function transformerFactory($input, $output): TransformerInterface
    {
        $transformer = $this->createMock(TransformerInterface::class);
        $transformer->method('transform')->willReturnCallback(function ($data) use ($input, $output) {
            $this->assertEquals($input, $data);

            return $output;
        });
        /** @var TransformerInterface $transformer */

        return $transformer;
    }
}
