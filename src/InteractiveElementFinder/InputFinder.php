<?php

namespace TestAutoAuto\InteractiveElementFinder;

use Facebook\WebDriver\WebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverElement;
use TestAutoAuto\Entity\TestElement;

class InputFinder implements InteractiveElementFinder
{

    /**
     * @param WebDriver $driver
     * @return array
     */
    public function findElements(WebDriver $driver)
    {
        $elements = $driver->findElements(WebDriverBy::tagName('input'));

        $returned_elements = [];
        foreach ($elements as $element) {
            $relement = new TestElement();
            $relement->setElement($element);
            $relement->setLocator($this->extractLocator($element));
            $returned_elements[] = $relement;
        }

        return $returned_elements;
    }

    private function extractLocator(WebDriverElement $element)
    {
        $id = $element->getAttribute('id');
        if ($id != null) {
            return '#' . $id;
        }

        $locator = 'input';

        $type = $element->getAttribute('type');
        if ($type != null) {
            $locator .= '[type='. $type .']';
        }

        $name = $element->getAttribute('name');
        if ($name != null) {
            $locator .= '[name='. $name .']';
        }
        return $locator;
    }


}