<?php

if(!function_exists('route_is')){
    function route_is($route=null){
        if(Request::routeIs($route)){
            return true;
        }else{
            return false;
        }
    }
}

if(!function_exists('route_is')){
    function route_is($routes=[]){
        foreach($routes as $route){
            if(Request::routeIs($route)){
                return true;
            }else{
                return false;
            }
        }
    }
}

if(!function_exists('notify')){
    function notify($message , $type='success'){
        return array(
            'message'=> $message,
            'alert-type' => $type,
        );
    }
}


if(!function_exists('alert')){
    function alert($message , $type='success'){
        return array(
            'alert'=> $message,
            'alert-type' => $type,
        );
    }
}
