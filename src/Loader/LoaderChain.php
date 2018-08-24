<?php

namespace ETL\Loader;

class LoaderChain implements LoaderInterface
{
    /** @var LoaderInterface[] */
    private $loaders;

    /**
     * LoaderChain constructor.
     *
     * @param LoaderInterface[] $loaders
     */
    public function __construct(array $loaders)
    {
        foreach ($loaders as $loader) {
            $this->addLoader($loader);
        }
    }

    /**
     * @inheritdoc
     */
    public function load($data): int
    {
        $counter = 0;

        foreach ($this->loaders as $loader) {
            $counter += $loader->load($data);
        }
        return $counter;
    }

    /**
     * @param LoaderInterface $loader
     */
    private function addLoader(LoaderInterface $loader)
    {
        $this->loaders[] = $loader;
    }
}
