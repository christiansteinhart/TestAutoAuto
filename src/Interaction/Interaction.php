<?php
/**
 * Created by PhpStorm.
 * User: christiansteinhart
 * Date: 30.08.17
 * Time: 16:29
 */

namespace TestAutoAuto\Interaction;


use Facebook\WebDriver\WebDriverElement;

interface Interaction
{
    public function execute(WebDriverElement $element);

    public function generateExecutionCode($elementVarName);
}