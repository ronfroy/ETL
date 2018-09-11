<?php

namespace ETL\Transformer;

use Symfony\Component\Serializer\Normalizer\DenormalizableInterface;

class DenormalizerTransformer implements TransformerInterface
{
    /** @var DenormalizableInterface */
    private $denormalizer;

    /** @var string */
    private $format;

    /** @var array */
    private $context;

    /**
     * DenormalizerTransformer constructor.
     *
     * @param DenormalizableInterface $denormalizer
     * @param string $format
     * @param array $context
     */
    public function __construct(DenormalizableInterface $denormalizer, string $format, array $context)
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
