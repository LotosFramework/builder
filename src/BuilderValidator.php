<?php

declare(strict_types=1);

namespace Lotos\DI\Builder;

use \ReflectionClass;
use \ReflectionMethod;
use \ReflectionNamedType;
use \ReflectionParameter;

use Lotos\DI\Builder\Exception\{
    ClassHasNotConstructorException,
    IgnoredTypeException,
    InstanceHasNoAliasException,
    NotFoundRegisteredRealisationException,
    NotInstantiableException,
    NotInterfaceInstanceException,
    NotOneRealisationRegisteredException,
    NullArgumentTypeException,
    NotFoundRegisteredArgumentsException,
    HasNoTypeException,
    RegisteredArgumentHasInvalidType,
    MethodHasNotParamsException
};
use Lotos\DI\Repository\{RepositoryInterface, ArgumentEntity};
use Lotos\Collection\Collection;

/**
 * Trait BuilderValidator валидирует параметры билдера
 *
 * @author McLotos <mclotos@xakep.ru>
 * @copyright https://github.com/LotosFramework/Builder/COPYRIGHT.md
 * @license https://github.com/LotosFramework/Builder/LICENSE.md
 * @package Lotos\DI
 * @subpackage Builder
 * @version 2.0.0
 */
trait BuilderValidator
{

    private array $ignoreTypes = [
        'string', 'int', 'bool', 'object', 'array', 'mixed'
    ];

    /**
     * @see Lotos\DI\Builder\BuilderValidatorInterface::ensureInstantiable
     */
    public function ensureInstantiable(ReflectionClass $instance) : void
    {
        if (!$instance->isInstantiable()) {
            throw new NotInstantiableException($instance->getName() . ' is not instantiable');
        }
    }

    /**
     * @see Lotos\DI\Builder\BuilderValidatorInterface::ensureHasConstructor
     */
    public function ensureHasConstructor(ReflectionClass $instance) : void
    {
        if (is_null($instance->getConstructor())) {
            throw new ClassHasNotConstructorException($instance->getName() . ' has no constructor');
        }
    }

    /**
     * @see Lotos\DI\Builder\BuilderValidatorInterface::ensureMethodHasParams
     */
    public function ensureMethodHasParams(ReflectionMethod $method) : void
    {
        if ($method->getNumberOfParameters() == 0) {
            throw new MethodHasNotParamsException(
                $method->getDeclaringClass()->getName() .
                ':' .
                $method->getName() .
                ' has no parameters');
        }
    }

    /**
     * @see Lotos\DI\Builder\BuilderValidatorInterface::ensureNotIgnoredType
     */
    public function ensureNotIgnoredType(ReflectionNamedType $type) : void
    {
        if (in_array($type->getName(), $this->ignoreTypes)) {
            throw new IgnoredTypeException($type->getName() . ' registered as ignored');
        }
    }

    /**
     * @see Lotos\DI\Builder\BuilderValidatorInterface::ensureNotNullArgumentType
     */
    public function ensureNotNullArgumentType(ReflectionParameter $parameter) : void
    {
        if (is_null($parameter->getType())) {
            throw new NullArgumentTypeException($parameter->getName() . ' has no type');
        }
    }

    /**
     * @see Lotos\DI\Builder\BuilderValidatorInterface::ensureInstanseIsInterface
     */
    public function ensureInstanseIsInterface(ReflectionClass $instance) : void
    {
        if (!$instance->isInterface()) {
            throw new NotInterfaceInstanceException($instance->getName() . ' is not interface');
        }
    }

    /**
     * @see Lotos\DI\Builder\BuilderValidatorInterface::ensureHasRegisteredRealisation
     */
    public function ensureHasRegisteredRealisation(Collection $collection, string $name) : void
    {
        if ($collection->count() < 1) {
            throw new NotFoundRegisteredRealisationException('Not found registered realisation for ' . $name);
        }
    }

    /**
     * @see Lotos\DI\Builder\BuilderValidatorInterface::ensureOnlyOneRegisteredRealisation
     */
    public function ensureOnlyOneRegisteredRealisation(Collection $collection, string $name) : void
    {
        if ($collection->count() !== 1) {
            throw new NotOneRealisationRegisteredException('Found more than one registered realisation for ' . $name);
        }
    }

    /**
     * @see Lotos\DI\Builder\BuilderValidatorInterface::ensureHasAlias
     */
    public function ensureHasAlias($instance) : void
    {
        if (is_null($instance->getAlias())) {
            throw new InstanceHasNoAliasException;
        }
    }

    /**
     * @see Lotos\DI\Builder\BuilderValidatorInterface::ensureMethodHasRegisteredParams
     */
    public function ensureMethodHasRegisteredParams(
        RepositoryInterface $repository,
        ReflectionMethod $method
    ) : void
    {
        if (
            $repository->getByClass($method->getDeclaringClass()->getName())
                ->getMethod($method->getDeclaringClass()->getConstructor()->getName())
                ->getArguments()
                ->count() === 0
        ) {
            throw new NotFoundRegisteredArgumentsException;
        }
    }

    /**
     * @see Lotos\DI\Builder\BuilderValidatorInterface::ensureHasType
     */
    public function ensureHasType(ReflectionParameter $parameter) : void
    {
        if ($parameter->hasType() === false) {
            throw new HasNoTypeException;
        }
    }

    /**
     * @see Lotos\DI\Builder\BuilderValidatorInterface::ensureArgumentHasValidType
     */
    public function ensureArgumentHasValidType(
        ArgumentEntity $entity,
        ReflectionParameter $parameter) : void {
        if ($parameter->hasType()) {
            if ($entity->getType() !== $parameter->getType()->getName()) {
                throw new RegisteredArgumentHasInvalidType;
            }
        }
    }
}
