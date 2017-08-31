<?php
/**
 * Created by PhpStorm.
 * User: christiansteinhart
 * Date: 30.08.17
 * Time: 16:39
 */

namespace TestAutoAuto\Helper;


use TestAutoAuto\Capability\Capability;
use TestAutoAuto\Entity\TestElement;

class CapabilityInvestigator
{
    /**
     * @var InteractionInvestigator[]
     */
    private $investigators = [];

    /**
     * @param InteractionInvestigator $investigator
     */
    public function addInvestigator(InteractionInvestigator $investigator)
    {
        $this->investigators[] = $investigator;
    }

    public function getCapabilities(TestElement $element)
    {
        foreach ($this->investigators as $investigator) {
            $capability = $investigator->getCapability($element);
            if ($capability instanceof Capability) {
                $element->addCapability($capability);
            }
        }
    }

}