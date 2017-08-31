<?php

namespace TestAutoAuto\WebDriver;


use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;

class WebdriverFactory
{
    /**
     * @var string
     */
    private $host;

    /**
     * @var int
     */
    private $timeout;

    /**
     * @param string $host
     * @param int $timeout
     */
    public function __construct($host, $timeout)
    {
        $this->host = $host;
        $this->timeout = $timeout;
    }

    public function getChromeDriver()
    {
        return $this->getDriver(DesiredCapabilities::chrome());
    }

    private function getDriver($capabilites)
    {
        return RemoteWebDriver::create($this->host, $capabilites, $this->timeout);
    }


}