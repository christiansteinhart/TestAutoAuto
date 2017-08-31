<?php

namespace TestAutoAuto\Capability;

use TestAutoAuto\Interaction\Interaction;

interface Capability
{
    /**
     * @return Interaction
     */
    public function getTestCases();
}