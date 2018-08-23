<?php
/**
 * Created by PhpStorm.
 * User: ronfroy
 * Date: 23/08/2018
 * Time: 14:21
 */

namespace ETL\Loader;

class NullLoader implements LoaderInterface
{
    /**
     * @inheritdoc
     */
    public function load($data): int
    {
        return 0;
    }
}
