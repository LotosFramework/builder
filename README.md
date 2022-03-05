# Builder

## Установка
```bash
composer require lotos/builder
```

## Сборка объекта

```php
$collection = CollectionFactory::createCollection();

$builder = BuilderFactory::createBuilder(
    repository: RepositoryFactory::createRepository($collection->newInstance()),
    collection: $collection
);

$entity = $builder->build(Lotos\TestClass::class);
```