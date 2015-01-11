<?php

namespace sat8bit\MyRoomba;

use sat8bit\RoombaSim\Roomba\RoombaAIInterface;
use sat8bit\RoombaSim\Roomba\Motion;

class MyRoombaAI implements RoombaAIInterface
{
    protected $directionFlag = 1;

    protected $lastCall = null;

    /**
     * when hit.
     *
     * @param int $distance
     * @return Motion
     */
    public function hit($distance)
    {
        if ($this->lastCall === 'ran') {
            $this->directionFlag *= -1;
        }

        // 角で２回hitした
        if ($this->lastCall === 'hit' && $distance === 0) {
            // 初期化
            $this->lastCall = null;
            return new Motion($this->directionFlag * 90, 1000);
        }

        $this->lastCall = 'hit';
        return new Motion(90 * $this->directionFlag, 1);
    }
    /**
     * when ran.
     *
     * @param int $distance
     * @return Motion
     */
    public function ran($distance)
    {
        $this->lastCall = 'ran';
        return new Motion(90 * $this->directionFlag, 1000);
    }
}
