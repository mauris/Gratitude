<?php

use Packfire\Application\Pack\Controller;

class PageController extends Controller{
    
    public function index(){
        $cache = $this->service('cache');
        /* @var $cache \Packfire\Cache\ICache */
        if(false !== $data = $cache->get('likes.json')){
            $this->state['data'] = json_decode($data, false);
        }
        $this->render();
    }
    
}
