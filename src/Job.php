<?php

declare(strict_types=1);

namespace ETL;

use ETL\Exception\JobException;
use ETL\Extractor\ExtractorInterface;
use ETL\Loader\LoaderInterface;
use ETL\Transformer\TransformerInterface;
use ETL\Validator\ValidatorInterface;

final class Job
{
    /** @var ExtractorInterface */
    private $extractor;

    /** @var TransformerInterface */
    private $transformer;

    /** @var LoaderInterface */
    private $loader;

    /** @var ValidatorInterface */
    private $validator;

    /**
     * Job constructor.
     *
     * @param ExtractorInterface   $extractor
     * @param TransformerInterface $transformer
     * @param LoaderInterface      $loader
     * @param ValidatorInterface   $validator
     */
    public function __construct(
        ExtractorInterface $extractor,
        TransformerInterface $transformer,
        LoaderInterface $loader,
        ValidatorInterface $validator
    ) {
        $this->extractor = $extractor;
        $this->transformer = $transformer;
        $this->loader = $loader;
        $this->validator = $validator;
    }

    /**
     * @throws \ETL\Exception\JobException
     *
     * @return int
     */
    public function run(): int
    {
        try {
            $iterator = $this->extractor->extract();

            $i = 0;
            $loaded = 0;
            foreach ($iterator as $batch) {
                try {
                    ++$i;
                    $data = $this->transformer->transform($batch);
                    unset($batch);
                    $this->validator->validate($data);
                    $loaded += $this->loader->load($data);
                    unset($data);
                } catch (\Throwable $throwable) { // @codeCoverageIgnore
                    throw JobException::batchFailed($i, $throwable);
                }
            }

            return $loaded;
        } catch (\Throwable $throwable) {
            throw JobException::jobFailed($throwable);
        }
    }
}
