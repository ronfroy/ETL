<?php

namespace ETL\Transformer;

class NullTransformer implements TransformerInterface
{
    /**
     * @inheritdoc
     */
    public function transform($data)
    {
        return $data;
    }
}
