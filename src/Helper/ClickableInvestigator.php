<?php

namespace TestAutoAuto\Helper;

use TestAutoAuto\Entity\TestElement;
use TestAutoAuto\Capability\Clickable;
use TestAutoAuto\Capability\Capability;

class ClickableInvestigator implements InteractionInvestigator
{
    /**
     * @param TestElement $element
     * @return Capability|null
     */
    public function getCapability(TestElement $element)
    {
        $tag = $element->getElement()->getTagName();

        if (in_array($tag,['a', 'input', 'button'])) {
            return new Clickable();
        }
    }
}