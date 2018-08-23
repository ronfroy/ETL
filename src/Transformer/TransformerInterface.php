<?php

declare(strict_types=1);

namespace ETL\Transformer;

interface TransformerInterface
{
    /**
     * @param mixed $data
     *
     * @return mixed
     */
    public function transform($data);
}
