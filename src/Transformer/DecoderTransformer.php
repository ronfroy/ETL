<?php

namespace ETL\Transformer;

use Symfony\Component\Serializer\Encoder\DecoderInterface;

class DecoderTransformer implements TransformerInterface
{
    /** @var DecoderInterface */
    private $decoder;

    /** @var string */
    private $format;

    /** @var array */
    private $context;

    /**
     * DecoderTransformer constructor.
     *
     * @param DecoderInterface $decoder
     * @param string $format
     * @param array $context
     */
    public function __construct(DecoderInterface $decoder, string $format, array $context)
    {
        $this->decoder = $decoder;
        $this->format = $format;
        $this->context = $context;
    }

    /**
     * @inheritdoc
     */
    public function transform($data)
    {
        return  $this->decoder->decode($data, $this->format, $this->context);
    }
}
