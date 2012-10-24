<?php

use Packfire\Application\Pack\View;

class PageIndexView extends View{
    
    function create(){
        $this->define('counts', count($this->state['data']));
        $this->define('profiles', $this->state['data']);
    }
    
}