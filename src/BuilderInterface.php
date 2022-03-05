<?php

declare(strict_types=1);

namespace Lotos\DI\Builder;

/**
 * Интерфейс BuilderInterface
 *
 * @author McLotos <mclotos@xakep.ru>
 * @copyright https://github.com/LotosFramework/Builder/COPYRIGHT.md
 * @license https://github.com/LotosFramework/Builder/LICENSE.md
 * @package Lotos\DI
 * @subpackage Builder
 * @version 2.0.0
 */
interface BuilderInterface
{
    /**
     * Метод build создает экземпляр вызываемого объекта
     *
     * @method build
     * @param string $class Имя создаваемого класса
     * @throws Lotos\DI\Builder\Exception\BuilderException Выдает исключение, если не удалось создать объект
     * @return object Объект созданный на основе класса
     */
    public function build(string $class) : object;
}
