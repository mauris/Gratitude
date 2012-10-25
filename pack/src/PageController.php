<?php

use Packfire\Application\Pack\Controller;
use Packfire\DateTime\DateTime;
use Packfire\DateTime\TimeSpan;
use Packfire\DateTime\DateTimeFormat;

class PageController extends Controller{
    
    public function index(){
        $cache = $this->service('cache');
        /* @var $cache \Packfire\Cache\ICache */
        if(false !== $data = $cache->get('likes.json')){
            $this->state['data'] = json_decode($data, false);
        }
        
        $now = DateTime::now();
        $expires = $now->add(new TimeSpan(900));
        /* @var $expires DateTime */
        $this->response->headers()->add('Last-Modified',
                $now->format(DateTimeFormat::RFC1123));
        $this->response->headers()->add('Expires',
                $expires->format(DateTimeFormat::RFC1123));
        $this->render();
    }
    
}
