<?php

declare(strict_types=1);

namespace Lotos\DI\Builder;

use \ReflectionClass;
use \ReflectionMethod;
use \ReflectionNamedType;
use \ReflectionParameter;

use Ds\Sequence as CollectionInterface;
use Lotos\DI\Repository\ArgumentEntity;

/**
 * Интерфейс BuilderValidatorInterface
 *
 * @author McLotos <mclotos@xakep.ru>
 * @copyright https://github.com/LotosFramework/Builder/COPYRIGHT.md
 * @license https://github.com/LotosFramework/Builder/LICENSE.md
 * @package Lotos\DI
 * @subpackage Builder
 * @version 2.0.0
 */
interface BuilderValidatorInterface
{

    /**
     * Метод ensureInstantiable проверяет что у сущности есть сохраненная реализация
     *
     * @method ensureInstantiable
     * @param \ReflectionClass $instance
     * @throws Lotos\DI\Builder\Exception\NotInstantiableException
     * @return void
     */
    public function ensureInstantiable(ReflectionClass $instance) : void;

    /**
     * Метод ensureHasConstructor проверяет что у сущности есть конструктор
     *
     * @method ensureHasConstructor
     * @param \ReflectionClass $instance
     * @throws Lotos\DI\Builder\Exception\ClassHasNotConstructorException
     * @return void
     */
    public function ensureHasConstructor(ReflectionClass $instance) : void;

    /**
     * Метод ensureMethodHasParams проверяет что у метода есть аргументы
     *
     * @method ensureMethodHasParams
     * @param \ReflectionMethod $method
     * @throws Lotos\DI\Builder\Exception\MethodHasNotParamsException
     * @return void
     */
    public function ensureMethodHasParams(ReflectionMethod $method) : void;

    /**
     * Метод ensureMethodHasRegisteredParams проверяет что у метода есть аргументы
     *
     * @method ensureMethodHasRegisteredParams
     * @param \ReflectionMethod $method
     * @throws Lotos\DI\Builder\Exception\NotFoundRegisteredArgumentsException
     * @return void
     */
    public function ensureMethodHasRegisteredParams(ReflectionMethod $method) : void;

    /**
     * Метод ensureNotIgnoredType проверяет что у аргумента не стандартный тип
     *
     * @method ensureNotIgnoredType
     * @param \ReflectionNamedType $type
     * @throws Lotos\DI\Builder\Exception\IgnoredTypeException
     * @return void
     */
    public function ensureNotIgnoredType(ReflectionNamedType $type) : void;

    /**
     * Метод ensureArgumentHasValidType проверяет что у аргумента правильный тип
     *
     * @method ensureArgumentHasValidType
     * @param Lotos\DI\Repository\ArgumentEntity $entity
     * @param \ReflectionParameter $parameter
     * @throws Lotos\DI\Builder\Exception\RegisteredArgumentHasInvalidType
     * @return void
     */
    public function ensureArgumentHasValidType(ArgumentEntity $entity, ReflectionParameter $parameter) : void;

    /**
     * Метод ensureNotNullArgumentType проверяет что у аргумента указан тип
     *
     * @method ensureNotNullArgumentType
     * @param \ReflectionNamedType $type
     * @throws Lotos\DI\Builder\Exception\NullArgumentTypeException
     * @return void
     */
    public function ensureNotNullArgumentType(?ReflectionNamedType $type = null) : void;

    /**
     * Метод ensureHasType проверяет что у аргумента есть тип
     *
     * @method ensureHasType
     * @param \ReflectionParameter $type
     * @throws Lotos\DI\Builder\Exception\HasNoTypeException
     * @return void
     */
    public function ensureHasType(ReflectionParameter $parameter) : void;

    /**
     * Метод ensureInstanseIsInterface проверяет что сущность является интерфейсом
     *
     * @method ensureInstanseIsInterface
     * @param \ReflectionClass $instance
     * @throws Lotos\DI\Builder\Exception\NotInterfaceInstanceException
     * @return void
     */
    public function ensureInstanseIsInterface(ReflectionClass $instance) : void;

    /**
     * Метод ensureHasRegisteredRealisation проверяет что есть зарегистрированная реализация класса
     *
     * @method ensureHasRegisteredRealisation
     * @param Lotos\Collection\CollectionInterface $collection
     * @throws Lotos\DI\Builder\Exception\NotFoundRegisteredRealisationException
     * @return void
     */
    public function ensureHasRegisteredRealisation(CollectionInterface $collection) : void;

    /**
     * Метод ensureOnlyOneRegisteredRealisation проверяет что есть только одна зарегистрированная реализация класса
     *
     * @method ensureOnlyOneRegisteredRealisation
     * @param Lotos\Collection\CollectionInterface $collection
     * @throws Lotos\DI\Builder\Exception\NotOneRealisationRegisteredException
     * @return void
     */
    public function ensureOnlyOneRegisteredRealisation(CollectionInterface $collection) : void;

    /**
     * Метод ensureHasAlias проверяет что указан алиас класса
     *
     * @method ensureHasAlias
     * @param $instance
     * @throws Lotos\DI\Builder\Exception\InstanceHasNoAliasException
     * @return void
     */
    public function ensureHasAlias($instance) : void;
}
