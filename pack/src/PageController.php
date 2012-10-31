<?php

use Packfire\Application\Pack\Controller;
use Packfire\DateTime\DateTime;
use Packfire\DateTime\TimeSpan;
use Packfire\DateTime\DateTimeFormat;
use Packfire\IO\File\File;

class PageController extends Controller{
    
    public function index(){
        $cache = $this->service('cache');
        /* @var $cache \Packfire\Cache\ICache */
        if(false !== $data = $cache->get('likes.json')){
            $this->state['data'] = json_decode($data, false);
        }
        
        $file = new File(__DIR__ . '/PageIndexView.html');
        $lastModified = $file->lastModified();
        if(file_exists('pack/storage/cache/FileCache-likes-json.cache')){
            $cacheLastModified = filemtime('pack/storage/cache/FileCache-likes-json.cache');
            if($cacheLastModified > $lastModified->toTimestamp()){
                $lastModified = DateTime::fromTimestamp($cacheLastModified);
            }
        }
        
        $now = DateTime::now();
        $expires = $now->add(new TimeSpan(900));
        /* @var $expires DateTime */
        $this->response->headers()->add('Last-Modified',
                $lastModified->format(DateTimeFormat::RFC1123));
        $this->response->headers()->add('Expires',
                $expires->format(DateTimeFormat::RFC1123));
        $this->render();
    }
    
}
