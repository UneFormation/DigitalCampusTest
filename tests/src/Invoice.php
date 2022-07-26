<?php

namespace AppTest;

class Invoice extends \App\Invoice
{
    /**
     * @param string $methodName
     * @return ReflectionMethod
     */
    public static function exposedMethod(string $methodName, ...$parameters): mixed
    {
        $object = new static();
        $reflexion = new \ReflectionClass($object);

        $method = $reflexion->getMethod($methodName);
        $method->setAccessible(true);
        return $method->invokeArgs($object, $parameters);
    }

    public static function multiplyTest(...$args)
    {
        return static::exposedMethod('multiply', ...$args);
    }

    public static function sum(...$args): float
    {
        return parent::sum(...$args);
    }
}