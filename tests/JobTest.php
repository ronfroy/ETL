<?php
namespace ETL\Test;

use ETL\Extractor\ExtractorInterface;
use ETL\Job;
use ETL\Loader\LoaderInterface;
use ETL\Transformer\TransformerInterface;
use ETL\Validator\ValidatorInterface;

class JobTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @param array $data
     * @param int $extract
     * @param int $transform
     * @param int $validation
     * @param int $load
     *
     * @throws \ETL\Exception\JobException
     *
     * @covers \ETL\Job::__construct
     * @covers \ETL\Job::run
     *
     * @throws \ETL\Exception\JobException
     *
     * @dataProvider provider
     */
    public function test(array $data, int $extract, int $transform, int $validation, int $load): void
    {
        $execution = [
            'extractor' => 0,
            'transformer' => 0,
            'loader' => 0,
            'validator' => 0,
        ];

        $extractor = $this->buildExtractorMock(function () use (&$execution, $data) {
            ++$execution['extractor'];

            return new \ArrayIterator($data);
        });

        $transformer = $this->buildTransformerMock(function ($batch) use (&$execution, $data) {
            $this->assertEquals($data[$execution['transformer']], $batch, 'data received in transformer are not the same');

            ++$execution['transformer'];

            return $batch;
        });

        $validator = $this->buildValidatorMock(function ($batch) use (&$execution, $data) {
            $this->assertEquals($data[$execution['validator']], $batch, 'data received in validator are not the same');

            ++$execution['validator'];
        });

        $loader = $this->buildLoaderMock(function ($batch) use (&$execution, $data) {
            $this->assertEquals($data[$execution['loader']], $batch, 'data received in loader are not the same');

            ++$execution['loader'];

            return 1;
        });

        $job = new Job($extractor, $transformer, $loader, $validator);

        $job->run();

        $this->assertEquals($extract, $execution['extractor'], sprintf('extractor must be executed %d time(s)', $extract));
        $this->assertEquals($transform, $execution['transformer'], sprintf('transformer must be executed %d time(s)', $transform));
        $this->assertEquals($load, $execution['loader'], sprintf('loader must be executed %d time(s)', $loader));
        $this->assertEquals($validation, $execution['validator'], sprintf('validator must be executed %d time(s)', $validator));
    }


    /**
     * @return array
     */
    public function provider(): array
    {
        return [
            'nothing to extract' => [ [], 1, 0, 0, 0 ],
            'one batch extracted' => [ [ 0 => 'data 1'], 1, 1, 1, 1 ],
            'two batch extracted' => [ [ 0 => 'data 1', 1 => 'data 2'], 1, 2, 2, 2 ],
        ];
    }

    /**
     * @param \Closure $extract
     *
     * @return ExtractorInterface
     */
    private function buildExtractorMock(\Closure $extract): ExtractorInterface
    {
        $mock = $this->createMock(ExtractorInterface::class);
        $mock->method('extract')
            ->will($this->returnCallback($extract))
        ;

        /* @var ExtractorInterface $mock */
        return $mock;
    }

    /**
     * @param \Closure $transform
     *
     * @return TransformerInterface
     */
    private function buildTransformerMock(\Closure $transform): TransformerInterface
    {
        $mock = $this->createMock(TransformerInterface::class);
        $mock->method('transform')
            ->will($this->returnCallback($transform))
        ;

        /* @var TransformerInterface $mock */
        return $mock;
    }

    /**
     * @param \Closure $validate
     *
     * @return ValidatorInterface
     */
    private function buildValidatorMock(\Closure $validate): ValidatorInterface
    {
        $mock = $this->createMock(ValidatorInterface::class);
        $mock->method('validate')
            ->will($this->returnCallback($validate))
        ;

        /* @var ValidatorInterface $mock */
        return $mock;
    }

    /**
     * @param \Closure $load
     *
     * @return LoaderInterface
     */
    private function buildLoaderMock(\Closure $load): LoaderInterface
    {
        $mock = $this->createMock(LoaderInterface::class);
        $mock->method('load')
            ->will($this->returnCallback($load))
        ;

        /* @var LoaderInterface $mock */
        return $mock;
    }
}
