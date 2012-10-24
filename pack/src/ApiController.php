<?php

use Packfire\Application\Pack\Controller;

class ApiController extends Controller {
    
    public function build(){
        $cache = $this->service('cache');
        /* @var $cache \Packfire\Cache\ICache */
        if(!$cache->check('likes.json')){
            // https://graph.facebook.com/300328703413848/likes
            ignore_user_abort(true);
            set_time_limit(0);

            $url = 'https://graph.facebook.com/300328703413848/likes';
            $data = true;
            $result = array();
            //$fh = fopen('likes.json', 'w');
            while($url){
                $data = file_get_contents($url);
                if($data){
                    $data = json_decode($data, true);
                    if(isset($data['data'])){
                        //foreach($data['data'] as $like){
                        //    fwrite($fh, $like['id'] . ' ' . $like['name'] . "\n");
                        //}
                        $result = array_merge($result, $data['data']);
                    }
                    if(isset($data['paging']['next'])){
                        $url = $data['paging']['next'];
                    }else{
                        $url = null;
                    }
                }
            }
            //fclose($fh);
            //file_put_contents('likes.json', json_encode($result));
            $cache->set('likes.json', json_encode($result), 3600);
        }
    }
    
}
