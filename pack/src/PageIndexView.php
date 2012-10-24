<?php

use Packfire\Application\Pack\View;

class PageIndexView extends View{
    
    function create(){
        $this->define('profiles', $this->state['data']);
    }
    
}