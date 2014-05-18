<?php

namespace Laraconway;

final class World
{
    protected $positions; 
    protected $numRows;
    protected $numColumns;

    protected function __construct($rows, $columns)
    {
        $this->numRows = $rows;
        $this->numColumns = $columns;

        for ($x = 0; $x < $rows; $x++) {
            for ($y = 0; $y < $columns; $y++) {
                $this->positions[$x][$y] = Cell::dead();
            }
        }
    }

    public static function create($rows = 100, $columns = 100)
    {
        return new self($rows, $columns);
    }

    public function placeLivingCell($x, $y)
    {
        $this->positions[$x][$y] = Cell::alive();
    }

    public function livingAt($x, $y)
    {
        if ($x < 0 || $y < 0 || $x > $this->numRows - 1  || $y > $this->numColumns - 1) {
            return false;
        }

        return $this->positions[$x][$y]->isAlive();
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
        $livingNeighbours = $this->countLivingNeighbours($x, $y);
        $cell = $this->positions[$x][$y];
        return $cell->nextState($livingNeighbours);
    }

    protected function countLivingNeighbours($x, $y)
    {
        $livingNeighbours = 0;
        for ($i = -1; $i <= 1; $i++) {
            for ($j = -1; $j <= 1; $j++) {
                if ($i == 0 && $j == 0) {
                    continue;
                }
                $livingNeighbours += $this->livingAt($x+$i, $y+$j) ? 1 : 0;
            }
        }

        return $livingNeighbours;
    }

    public function draw()
    {
        $serialized = [];
        foreach ($this->positions as $row) {
            $rowRep = [];
            foreach ($row as $cell) {
                 $rowRep[] = $cell->isAlive() ? "X" : " ";
            }
            $serialized[] = $rowRep;
        }
        return $serialized;
    }
}
