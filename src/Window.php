<?php

namespace Laraconway;

class Window
{
    protected $canvas = null;

    protected $world;

    public function __construct($world)
    {
        $this->world = $world;
    }

    public function init()
    {
        ncurses_init();

        $this->canvas = ncurses_newwin(0, 0, 0, 0);
        ncurses_border(0,0, 0,0, 0,0, 0,0);

        // now lets create a small window

        $small = ncurses_newwin(40, 100, 1, 10);

        // border our small window.

        ncurses_wborder($small,0,0, 0,0, 0,0, 0,0);

        ncurses_refresh();// paint both windows

        // move into the small window and write a string

        while(true) {

            $rep = $this->world->draw();
            $this->world->tick();
            $str = '';
            foreach ($rep as $row) {
                $str .= implode('', $row); // . "\n";
            }
            ncurses_mvwaddstr($small, 0, 0, $str);

            usleep(50000);
            ncurses_wrefresh($small);
        }
    }
}
