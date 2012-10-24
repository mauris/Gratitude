<?php

use Packfire\Application\Pack\Controller;

class PageController extends Controller{
    
    public function index(){
        $cache = $this->service('cache');
        /* @var $cache \Packfire\Cache\ICache */
        $this->state['data'] = json_decode($cache->get('likes.json'), false);
        $this->render();
    }
    
}
