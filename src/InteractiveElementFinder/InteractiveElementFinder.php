<?php

namespace TestAutoAuto\InteractiveElementFinder;


use Facebook\WebDriver\WebDriver;

interface InteractiveElementFinder
{
    /**
     * @param WebDriver $driver
     * @return array
     */
    public function findElements(WebDriver $driver);
}