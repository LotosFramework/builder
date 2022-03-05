<?php

declare(strict_types=1);

namespace Lotos\DI\Builder;

use Lotos\DI\Repository\RepositoryInterface;
use Lotos\DI\Builder\BuilderInterface;

use Lotos\Collection\Collection;

/**
 * Класс BuilderFactory можно использовать для удобного получения билдера
 *
 * @author McLotos <mclotos@xakep.ru>
 * @copyright https://github.com/LotosFramework/Builder/COPYRIGHT.md
 * @license https://github.com/LotosFramework/Builder/LICENSE.md
 * @package Lotos\DI
 * @subpackage Builder
 * @version 2.0.0
 */
class BuilderFactory
{
    /**
     * Метод createBuilder создает экземпляр объекта билдера
     *
     * Билдер всегда должен получать Репозиторий и Коллекцию в качестве аргументов.
     * Репозиторий будет нужен для получения из них сущностей,
     *  а Коллекция для временного хранения служебных данных
     *
     * @method createBuilder
     * @param Lotos\DI\Repository\RepositoryInterface $repository
     * @param Lotos\Collection\Collection $collection
     * @return Lotos\DI\Builder\BuilderInterface
     */
    public static function createBuilder(
        RepositoryInterface $repository,
        Collection $collection) : BuilderInterface
    {
        return new Builder(repository: $repository, collection: $collection);
    }
}
