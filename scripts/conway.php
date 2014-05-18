<?php

use Laraconway\World;
use Laraconway\Window;

require __DIR__ . "/../vendor/autoload.php";

$rows = 40;
$columns = 100;
$world = World::create($rows, $columns);

for ($x = 0; $x < $rows; $x++) {
    for ($y = 0; $y < $columns; $y++) {
        if (rand(0, 100) < 20) {
            $world->placeLivingCell($x, $y);
        }
    }
}

(new Window($world))->init();
