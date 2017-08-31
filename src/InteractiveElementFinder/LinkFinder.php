<?php

namespace TestAutoAuto\InteractiveElementFinder;

use Facebook\WebDriver\WebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverElement;
use TestAutoAuto\Entity\TestElement;

class LinkFinder implements InteractiveElementFinder
{

    /**
     * @param WebDriver $driver
     * @return array
     */
    public function findElements(WebDriver $driver)
    {
        $elements = $driver->findElements(WebDriverBy::cssSelector('a[href]'));
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

        $locator = 'a';

        $html = $element->getAttribute('outerHTML');
        if (preg_match("@^<a[^>]+href=['\"]([^'\"]+)@", $html, $matches) == 1) {
            $href = $matches[1];
            if ($href != null) {
                $locator .= '[href=\''. $href .'\']';
            }
        }


        return $locator;
    }
}