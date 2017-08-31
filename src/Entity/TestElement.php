<?php

namespace TestAutoAuto\Entity;

use Facebook\WebDriver\WebDriverElement;
use TestAutoAuto\Capability\Capability;

class TestElement
{
    /**
     * @var string
     */
    private $locator;

    /**
     * @var WebDriverElement
     */
    private $element;

    /**
     * @var Capability[]
     */
    private $capabilities;

    /**
     * @return string
     */
    public function getLocator()
    {
        return $this->locator;
    }

    /**
     * @param string $locator
     */
    public function setLocator($locator)
    {
        $this->locator = $locator;
    }

    /**
     * @return WebDriverElement
     */
    public function getElement()
    {
        return $this->element;
    }

    /**
     * @param WebDriverElement $element
     */
    public function setElement($element)
    {
        $this->element = $element;
    }

    /**
     * @return Capability[]
     */
    public function getCapabilities()
    {
        return $this->capabilities;
    }

    /**
     * @param Capability $capability
     */
    public function addCapability($capability)
    {
        $this->capabilities[] = $capability;
    }

    public function getTestCases()
    {
        $testCases = [];
        foreach ($this->capabilities as $capability) {
            $testCases = array_merge($testCases, $capability->getTestCases());

        }
        return $testCases;
    }
}