<?php

namespace Laraconway;

class Cell
{
    protected $isAlive;

    public function __construct($isAlive)
    {
        $this->isAlive = $isAlive;
    }

    public static function alive()
    {
        return new self(true);
    }

    public static function dead()
    {
        return new self(false);
    }

    public function isAlive()
    {
        return $this->isAlive;
    }

    public function isDead()
    {
        return !$this->isAlive();
    }

    public function nextState($livingNeighbours)
    {
        if ($this->isAlive() && $livingNeighbours < 2) {
            return Cell::dead();
        }
        if ($this->isAlive() && $livingNeighbours > 3) {
            return Cell::dead();
        }
        if ($this->isDead() && $livingNeighbours != 3) {
            return Cell::dead();
        }

        return Cell::alive();
    }
}
