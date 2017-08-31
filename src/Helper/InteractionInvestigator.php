<?php
/**
 * Created by PhpStorm.
 * User: christiansteinhart
 * Date: 30.08.17
 * Time: 16:46
 */

namespace TestAutoAuto\Helper;

use TestAutoAuto\Entity\TestElement;
use TestAutoAuto\Capability\Capability;

interface InteractionInvestigator
{
    /**
     * @param TestElement $element
     * @return Capability
     */
    public function getCapability(TestElement $element);
}