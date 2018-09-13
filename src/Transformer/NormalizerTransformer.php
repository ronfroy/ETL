<?php

namespace ETL\Transformer;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class NormalizerTransformer implements TransformerInterface
{
    /** @var NormalizerInterface */
    private $normalizer;

    /** @var string */
    private $format;

    /** @var array */
    private $context;

    /**
     * NormalizerTransformer constructor.
     *
     * @param NormalizerInterface $normalizer
     * @param string $format
     * @param array $context
     */
    public function __construct(NormalizerInterface $normalizer, string $format, array $context)
    {
        $this->normalizer = $normalizer;
        $this->format = $format;
        $this->context = $context;
    }


    /**
     * @inheritdoc
     */
    public function transform($data)
    {
        return  $this->normalizer->normalize($data, $this->format, $this->context);
    }
}
