<?php

use Packfire\Application\Pack\Controller;

class PageController extends Controller{
    
    public function index(){
        $this->state['data'] = json_decode(file_get_contents('likes.json'), false);
        $this->render();
    }
    
}
