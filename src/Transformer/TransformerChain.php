<?php

namespace ETL\Transformer;

class TransformerChain implements TransformerInterface
{
    /** @var TransformerInterface[] */
    private $transformers = [];

    /**
     * TransformerChain constructor.
     *
     * @param TransformerInterface[] $transformers
     */
    public function __construct(array $transformers)
    {
        foreach ($transformers as $transformer) {
            $this->addTransformer($transformer);
        }
    }

    /**
     * @inheritdoc
     */
    public function transform($data)
    {
        foreach ($this->transformers as $transformer) {
            $data = $transformer->transform($data);
        }
        
        return $data;
    }


    /**
     * @param TransformerInterface $transformer
     */
    private function addTransformer(TransformerInterface $transformer)
    {
        $this->transformers[] = $transformer;
    }
}
