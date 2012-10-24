<?php

use Packfire\Application\Pack\View;

class PageIndexView extends View{
    
    function create(){
        if(isset($this->state['data'])){
            $this->define('counts', count($this->state['data']));
            $this->define('profiles', $this->state['data']);
        }else{
            $this->define('counts', '');
        }
    }
    
}