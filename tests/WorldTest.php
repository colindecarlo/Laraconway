<?php

namespace Laraconway;

class WorldTest extends \PHPUnit_Framework_TestCase
{
    public function test_can_place_living_cell()
    {
        $world = World::create();
        $world->placeLivingCell(50, 50);
        $this->assertTrue($world->livingAt(50, 50));
        $this->assertFalse($world->livingAt(0, 0));
    }

    public function test_live_cell_with_fewer_than_two_live_neighbours_dies()
    {
        $world = World::create();
        $world->placeLivingCell(1, 1);
        $world->tick();
        $this->assertFalse($world->livingAt(1, 1));
    }
}
