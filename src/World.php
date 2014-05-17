<?php

namespace Laraconway;

final class World
{
    protected $positions; 

    protected function __construct($rows = 100, $columns = 100)
    {
        for ($x = 0; $x < $rows; $x++) {
            for ($y = 0; $y < $columns; $y++) {
                $this->positions[$x][$y] = false;
            }
        }
    }

    public static function create()
    {
        return new self;
    }

    public function placeLivingCell($x, $y)
    {
        $this->positions[$x][$y] = true;
    }

    public function livingAt($x, $y)
    {
        if (!isset($this->positions[$x])) {
            return false;
        }

        return isset($this->positions[$x][$y]) ? $this->positions[$x][$y] : false;
    }

    public function tick()
    {
        $newWorld = [];
        foreach($this->positions as $x => $row) {
            foreach($row as $y => $cell) {
                $newWorld[$x][$y] = $this->nextStateAt($x, $y);
            }
        }
        $this->positions = $newWorld;
    }

    protected function nextStateAt($x, $y)
    {
        return false;
    }
}
