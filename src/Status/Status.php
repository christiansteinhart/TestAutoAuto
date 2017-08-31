<?php

namespace TestAutoAuto\Status;

use Facebook\WebDriver\WebDriver;

class Status
{
    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $htmlContent;

    public static function createFromDriver(WebDriver $driver)
    {
        $status = new Status();
        $status->url = $driver->getCurrentURL();
        $status->htmlContent = $driver->getPageSource();
        return $status;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getHtmlContent()
    {
        return $this->htmlContent;
    }
}