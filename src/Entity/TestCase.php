<?php

namespace TestAutoAuto\Entity;


use Facebook\WebDriver\WebDriver;
use TestAutoAuto\Status\Status;

class TestCase
{
    /**
     * @var string
     */
    private $url;

    /**
     * @var TestCase
     */
    private $previous;

    /**
     * @var TestStep
     */
    private $step;

    /**
     * @var Status
     */
    private $result;

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return TestCase
     */
    public function getPrevious()
    {
        return $this->previous;
    }

    /**
     * @param TestCase $previous
     */
    public function setPrevious($previous)
    {
        $this->previous = $previous;
    }

    /**
     * @return TestStep
     */
    public function getStep()
    {
        return $this->step;
    }

    /**
     * @param TestStep $step
     */
    public function setStep($step)
    {
        $this->step = $step;
    }

    /**
     * @return Status
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param Status $result
     */
    public function setResult($result)
    {
        $this->result = $result;
    }

    public function execute(WebDriver $driver)
    {
        if ($this->previous !== null) {
            $this->previous->execute($driver);
        } else {
            $driver->get($this->url);
        }
        $this->step->execute($driver);
    }

    public function generateExecutionCode($driverVarName)
    {
        $code = '';
        if ($this->previous !== null) {
            $code = $this->previous->generateExecutionCode($driverVarName);
        } else {
            $code .= "\t\t" . $driverVarName . '->get(\'' . $this->url . '\');' . PHP_EOL;
        }
        $code .= $this->step->generateExecutionCode($driverVarName);
        return $code;
    }

    public function verify(WebDriver $driver)
    {
        return $this->result == $driver->getPageSource();

    }

    public function generateVerificationCode($driverVarName)
    {
        $code = '';
        $code .= "\t\t" . '$this->assertEquals(\'' . $this->result->getUrl() . '\', ' . $driverVarName . '->getCurrentUrl());' . PHP_EOL;
        $code .= "\t\t" . '$this->assertEquals(\'' . addcslashes($this->result->getHtmlContent(), '\'') . '\', ' . $driverVarName . '->getPageSource());' . PHP_EOL;

        return $code;
    }
}