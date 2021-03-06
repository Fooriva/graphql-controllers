<?php
namespace TheCodingMachine\GraphQL\Controllers;

use Roave\BetterReflection\Reflection\ReflectionParameter;

class MissingTypeHintException extends GraphQLException
{
    public static function missingTypeHint(ReflectionParameter $parameter)
    {
        return new self(sprintf('Parameter "%s" of method "%s::%s" is missing a type-hint', $parameter->getName(), $parameter->getDeclaringClass()->getName(), $parameter->getDeclaringFunction()->getName()));
    }
}