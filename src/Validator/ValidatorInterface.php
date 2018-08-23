<?php

declare(strict_types=1);

namespace ETL\Validator;

interface ValidatorInterface
{
    /**
     * @param mixed $data
     */
    public function validate($data): void;
}
