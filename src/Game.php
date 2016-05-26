<?php
namespace Bowling;

class Game
{
    /** @var int $score  */
    private $score = 0;
    /** @var array  */
    private $rolls = array();
    /** @var int  */
    private $currentRoll = 0;

    /**
     * Game constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param int $pins
     */
    public function roll($pins)
    {
        $this->score += $pins;
        $this->rolls[$this->currentRoll++] = $pins;
    }

    /**
     * @return int
     */
    public function score()
    {
        $score = 0;
        $rollIndex = 0;
        for ($frame = 0; $frame < 10; $frame++) {
            // spare
            if ($this->isStrike($rollIndex)) {
                $score += 10 + $this->strikeBonus($rollIndex);
                $rollIndex++;
            } elseif ($this->isSpare($rollIndex)) {
                $score += 10 + $this->rolls[$rollIndex + 2];
                $rollIndex+=2;
            } else {
                $score += $this->rolls[$rollIndex] + $this->rolls[$rollIndex +1];
                $rollIndex+=2;
            }
        }

        return $score;
    }

    /**
     * @param $currentRoll
     * @return bool
     */
    public function isSpare($currentRoll)
    {
        return ($this->rolls[$currentRoll] + $this->rolls[$currentRoll + 1]) == 10;
    }

    /**
     * @param $rollIndex
     * @return bool
     */
    public function isStrike($rollIndex)
    {
        return $this->rolls[$rollIndex] == 10;
    }

    /**
     * @param $rollIndex
     * @return mixed
     */
    public function strikeBonus($rollIndex)
    {
        $strikeBonus = $this->rolls[$rollIndex + 1]
            + $this->rolls[$rollIndex + 2];
        return $strikeBonus;
    }
}