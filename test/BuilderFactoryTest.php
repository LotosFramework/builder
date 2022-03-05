<?php

declare(strict_types=1);

namespace LotosTest\Builder;

use PHPUnit\Framework\TestCase;

use Lotos\DI\Repository\{
    RepositoryFactory,
    ArgumentsCollectionFactory
};

use Lotos\DI\Builder\{
    BuilderFactory,
    Builder
};

class BuilderFactoryTest extends TestCase
{
    /**
     * @test
     * @requires PHP >= 8.0
     * @covers BuilderFactory::createBuilder
     */
    public function createBuilder() : void
    {
        $collection = ArgumentsCollectionFactory::createCollection();
        $this->assertInstanceOf(
            Builder::class,
            BuilderFactory::createBuilder(
                collection: $collection,
                repository: RepositoryFactory::createRepository($collection)
            ),
            'Не удалось получить класс Builder из фабрики'
        );
    }
}
