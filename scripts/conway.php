<?php

use Laraconway\World;

require __DIR__ . "/../vendor/autoload.php";

$rows = $columns = 25;
$world = World::create($rows, $columns);

//for ($x = 0; $x < $rows; $x++) {
    //for ($y = 0; $y < $columns; $y++) {
        //if (rand(0, 100) < 18) {
            //$world->placeLivingCell($x, $y);
        //}
    //}
//}
//
$world->placeLivingCell(2, 0);
$world->placeLivingCell(2, 1);
$world->placeLivingCell(2, 2);
$world->placeLivingCell(1, 2);
$world->placeLivingCell(0, 1);

while (true) {
    $world->tick();
}
