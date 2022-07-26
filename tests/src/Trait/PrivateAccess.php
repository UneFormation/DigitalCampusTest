<?php

namespace AppTest\Trait;

Trait PrivateAccess
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
}