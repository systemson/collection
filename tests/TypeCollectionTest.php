<?php

namespace Tests;

use Amber\Collection\TypedCollection as Collection;
use PHPUnit\Framework\TestCase;
use Tests\Traits\{
    BasicTrait,
    MultipleTrait,
    AssociativeCollectionTrait,
    PushToTrait,
    SecuencialCollectionTrait,
    ArrayFunctionsTrait,
    StatementsTrait,
    CommonTrait
};

class TypeCollectionTest extends TestCase
{
    protected $collection = Collection::class;

    private function newCollection(array $array = [], string $type)
    {
        return new $this->collection($array, $type);
    }

    public function testInvalidType()
    {
        $this->expectException(\RuntimeException::class);

        $this->newCollection([], 'wrong');

    }

    protected function getTypedVariable(string $type)
    {
        switch ($type) {
            case 'numeric':
            case 'int':
            case 'integer':
                return 1;
                break;

            case 'double':
            case 'float':
                return 1.2;
                break;

            case 'string':
                return 'string';
                break;

            case 'array':
                return [];
                break;

            case 'bool':
            case 'boolean':
                return true;
                break;

            case 'object':
                return new \stdClass();
                break;

            case 'callable':
                return [Collection::make(), 'set'];
                break;
        }

        if (is_string($type) && class_exists($type)) {
            return new $type;
        }
    }

    public function typedTest($type)
    {
        $collection = $this->newCollection([], $type);

        $this->assertEquals($type, $collection->getType());

        $collection->set($type, $this->getTypedVariable($type));

        $this->expectException(\RuntimeException::class);

        if ($type != 'string') {
            $collection->set('string', 'string');
        } else {
            $collection->set('int', 1);
        }
    }

    public function testNumeric()
    {
        $this->typedTest('numeric');
    }

    public function testInteger()
    {
        $this->typedTest('integer');
    }

    public function testInt()
    {
        $this->typedTest('int');
    }

    public function testFloat()
    {
        $this->typedTest('float');
    }

    public function testDouble()
    {
        $this->typedTest('double');
    }

    public function testString()
    {
        $this->typedTest('string');
    }

    public function testArray()
    {
        $this->typedTest('array');
    }

    public function testBool()
    {
        $this->typedTest('bool');
    }

    public function testBoolean()
    {
        $this->typedTest('boolean');
    }

    public function testObject()
    {
        $this->typedTest('object');
    }

    public function testCallable()
    {
        $this->typedTest('callable');
    }

    public function testClass()
    {
        $this->typedTest(Collection::class);
    }

    public function testWrong()
    {
        $this->expectException(\RuntimeException::class);
        $this->typedTest('wrong');
    }
}
