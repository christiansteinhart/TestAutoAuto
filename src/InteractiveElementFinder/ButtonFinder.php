<?php
/**
 * Created by PhpStorm.
 * User: christiansteinhart
 * Date: 30.08.17
 * Time: 02:24
 */

namespace TestAutoAuto\InteractiveElementFinder;


use Facebook\WebDriver\WebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverElement;
use TestAutoAuto\Entity\TestElement;

class ButtonFinder implements InteractiveElementFinder
{

    /**
     * @param WebDriver $driver
     * @return array
     */
    public function findElements(WebDriver $driver)
    {
        $elements = $driver->findElements(WebDriverBy::tagName('button'));

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

        $locator = 'button';

        $type = $element->getAttribute('type');
        if ($type != null) {
            $locator .= '[type=' . $type . ']';
        }

        $name = $element->getAttribute('name');
        if ($name != null) {
            $locator .= '[type=' . $name . ']';
        }
        return $locator;
    }
}