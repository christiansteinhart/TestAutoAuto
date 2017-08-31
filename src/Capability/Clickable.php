<?php
/**
 * Created by PhpStorm.
 * User: christiansteinhart
 * Date: 30.08.17
 * Time: 16:27
 */

namespace TestAutoAuto\Capability;


use TestAutoAuto\Interaction\Click;
use TestAutoAuto\Interaction\Interaction;

class Clickable implements Capability
{

    /**
     * @return Interaction[]
     */
    public function getTestCases()
    {
        return [
            new Click()
        ];
    }
}