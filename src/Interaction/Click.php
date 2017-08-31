<?php

namespace TestAutoAuto\Interaction;

use Facebook\WebDriver\WebDriverElement;

class Click implements Interaction
{
    public function execute(WebDriverElement $element)
    {
        $element->click();
    }

    public function generateExecutionCode($elementVarName)
    {
        return "\t\t" . $elementVarName . '->click();' . PHP_EOL;
    }
}