<?php

namespace ETL\Transformer;

use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class DenormalizerTransformer implements TransformerInterface
{
    /** @var DenormalizerInterface */
    private $denormalizer;

    /** @var string */
    private $format;

    /** @var array */
    private $context;

    /**
     * DenormalizerTransformer constructor.
     *
     * @param DenormalizerInterface $denormalizer
     * @param string $format
     * @param array $context
     */
    public function __construct(DenormalizerInterface $denormalizer, string $format, array $context)
    {
        $this->denormalizer = $denormalizer;
        $this->format = $format;
        $this->context = $context;
    }

    /**
     * @inheritdoc
     */
    public function transform($data)
    {
        return  $this->denormalizer->denormalize($data, $this->format, $this->context);
    }
}
