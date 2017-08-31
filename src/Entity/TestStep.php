<?php

namespace TestAutoAuto\Entity;

use Facebook\WebDriver\WebDriver;
use Facebook\WebDriver\WebDriverBy;
use TestAutoAuto\Interaction\Interaction;

class TestStep
{
    /**
     * @var TestElement
     */
    private $element;

    /**
     * @var Interaction
     */
    private $interaction;

    /**
     * @return TestElement
     */
    public function getElement()
    {
        return $this->element;
    }

    /**
     * @param TestElement $element
     */
    public function setElement($element)
    {
        $this->element = $element;
    }

    /**
     * @return Interaction
     */
    public function getInteraction()
    {
        return $this->interaction;
    }

    /**
     * @param Interaction $interaction
     */
    public function setInteraction($interaction)
    {
        $this->interaction = $interaction;
    }

    public function execute(WebDriver $driver)
    {
        $element = $driver->findElement(WebDriverBy::cssSelector($this->element->getLocator()));
        $this->interaction->execute($element);
    }

    public function generateExecutionCode($driverVarName)
    {
        $code = '';
        $code .= "\t\t" . '$element = ' . $driverVarName . '->findElement(' . PHP_EOL;
        $code .= "\t\t\t" . WebDriverBy::class . '::cssSelector(\''. addcslashes($this->element->getLocator(), "'") . '\')' . PHP_EOL;
        $code .= "\t\t" . ');' . PHP_EOL;

        $code .= $this->interaction->generateExecutionCode('$element');

        return $code;
    }
}