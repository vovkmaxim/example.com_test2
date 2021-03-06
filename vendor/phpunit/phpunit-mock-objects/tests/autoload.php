<?php
// @codingStandardsIgnoreFile
// @codeCoverageIgnoreStart
// this is an autogenerated file - do not edit
spl_autoload_register(
    function($class) {
        static $classes = null;
        if ($classes === null) {
            $classes = array(
                'abstractmocktestclass' => '/_fixture/AbstractMockTestClass.php',
                'abstracttrait' => '/_fixture/AbstractTrait.php',
                'aninterface' => '/_fixture/AnInterface.php',
                'anotherinterface' => '/_fixture/AnotherInterface.php',
                'bar' => '/_fixture/Bar.php',
                'foo' => '/_fixture/Foo.php',
                'framework_mockbuildertest' => '/MockBuilderTest.php',
                'framework_mockobject_generatortest' => '/GeneratorTest.php',
                'framework_mockobject_invocation_objecttest' => '/MockObject/Invocation/ObjectTest.php',
                'framework_mockobject_invocation_statictest' => '/MockObject/Invocation/StaticTest.php',
                'framework_mockobjecttest' => '/MockObjectTest.php',
                'framework_proxyobjecttest' => '/ProxyObjectTest.php',
                'interfacewithstaticmethod' => '/_fixture/InterfaceWithStaticMethod.php',
                'methodcallback' => '/_fixture/MethodCallback.php',
                'methodcallbackbyreference' => '/_fixture/MethodCallbackByReference.php',
                'mockable' => '/_fixture/Mockable.php',
                'partialmocktestclass' => '/_fixture/PartialMockTestClass.php',
                'someclass' => '/_fixture/SomeClass.php',
                'staticmocktestclass' => '/_fixture/StaticMockTestClass.php',
                'traversablemocktestinterface' => '/_fixture/TraversableMockTestInterface.php'
            );
        }
        $cn = strtolower($class);
        if (isset($classes[$cn])) {
            require __DIR__ . $classes[$cn];
        }
    }
);
// @codeCoverageIgnoreEnd
