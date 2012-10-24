<?php

use Packfire\Application\Pack\Controller;

class ApiController extends Controller {
    
    public function build(){
        // https://graph.facebook.com/300328703413848/likes
        $url = 'https://graph.facebook.com/300328703413848/likes';
        $data = true;
        $result = array();
        while($url){
            $data = file_get_contents($url);
            if($data){
                $data = json_decode($data, true);
                if(isset($data['data'])){
                    $result = array_merge($result, $data['data']);
                }
                if(isset($data['paging']['next'])){
                    $url = $data['paging']['next'];
                }
            }
        }
        file_put_contents('likes.json', json_encode($result));
    }
    
}
