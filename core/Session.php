<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Session
 *
 * @author travail
 */
class  Session {
  
    static function set($k,$v){
        $k="'$k'";
        $_SESSION[$k]=$v;
    }
    static function get($k){
        $k="'$k'";
        if(isset($_SESSION[$k])){
        return $_SESSION[$k];
        }
        else{
            return null;
        }
    }
    function __destruct() {
        session_destroy();
    }
}
