<?php
return
<<<'TEMPLATE'
<?php

class %s extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \TestAutoAuto\WebDriver\WebdriverFactory
     */
    private static $webdriverFactory;

    /**
     * @var \Facebook\WebDriver\WebDriver
     */
    private $driver;

    public static function setUpBeforeClass()
    {
        self::$webdriverFactory = new \TestAutoAuto\WebDriver\WebdriverFactory("http://localhost:4444/wd/hub", 5000);
    }

    protected function setUp()
    {
        $this->driver = self::$webdriverFactory->getChromeDriver();
    }

    protected function tearDown()
    {
        $this->driver->close();
    }
    
%s
}
TEMPLATE
;