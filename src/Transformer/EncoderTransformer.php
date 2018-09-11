<?php

namespace ETL\Transformer;

use Symfony\Component\Serializer\Encoder\EncoderInterface;

class EncoderTransformer implements TransformerInterface
{
    /** @var EncoderInterface */
    private $encoder;

    /** @var string */
    private $format;

    /** @var array */
    private $context;

    /**
     * EncoderTransformer constructor.
     *
     * @param EncoderInterface $encoder
     * @param string $format
     * @param array $context
     */
    public function __construct(EncoderInterface $encoder, string $format, array $context = [])
    {
        $this->encoder = $encoder;
        $this->format = $format;
        $this->context = $context;
    }

    /**
     * @inheritdoc
     */
    public function transform($data)
    {
        return  $this->encoder->encode($data, $this->format, $this->context);
    }
}
