<?php


namespace TheCodingMachine\GraphQL\Controllers\Fixtures;

use TheCodingMachine\GraphQL\Controllers\Annotations\Logged;
use TheCodingMachine\GraphQL\Controllers\Annotations\Mutation;
use TheCodingMachine\GraphQL\Controllers\Annotations\Query;
use TheCodingMachine\GraphQL\Controllers\Annotations\Right;

class TestController
{
    /**
     * @Query
     * @param int $int
     * @param TestObject[] $list
     * @param bool|null $boolean
     * @param float|null $float
     * @param \DateTimeImmutable|null $dateTimeImmutable
     * @param \DateTime|\DateTimeInterface|null $dateTime
     * @param string $withDefault
     * @param null|string $string
     * @return TestObject
     */
    public function test(int $int, array $list, ?bool $boolean, ?float $float, ?\DateTimeImmutable $dateTimeImmutable, ?\DateTimeInterface $dateTime, string $withDefault = 'default', ?string $string = null): TestObject
    {
        $str = '';
        foreach ($list as $test) {
            if (!$test instanceof TestObject) {
                throw new \RuntimeException('TestObject instance expected.');
            }
            $str .= $test->getTest();
        }
        return new TestObject($string.$int.$str.($boolean?'true':'false').$float.$dateTimeImmutable->format('YmdHis').$dateTime->format('YmdHis').$withDefault);
    }

    /**
     * @Mutation
     * @param TestObject $testObject
     * @return TestObject
     */
    public function mutation(TestObject $testObject): TestObject
    {
        return $testObject;
    }

    /**
     * @Query
     * @Logged
     */
    public function testLogged(): TestObject
    {
        return new TestObject('foo');
    }

    /**
     * @Query
     * @Right(name="CAN_FOO")
     */
    public function testRight(): TestObject
    {
        return new TestObject('foo');
    }
}
