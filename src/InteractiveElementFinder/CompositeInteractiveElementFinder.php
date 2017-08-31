<?php

namespace TestAutoAuto\InteractiveElementFinder;

use Facebook\WebDriver\WebDriver;

class CompositeInteractiveElementFinder implements InteractiveElementFinder
{
    /**
     * @var InteractiveElementFinder[]
     */
    private $interactiveElementFinders = [];

    public function addFinder(InteractiveElementFinder $interactiveElementFinder)
    {
        $this->interactiveElementFinders[] = $interactiveElementFinder;
    }

    /**
     * @param WebDriver $driver
     * @return array
     */
    public function findElements(WebDriver $driver)
    {
        $result = [];
        foreach ($this->interactiveElementFinders as $finder) {
            $elements = $finder->findElements($driver);


            $result = array_merge($result, $elements);
        }
        return $result;
    }
}