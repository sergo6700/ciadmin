<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('valid_roll') ) {
     function valid_roll($roll){
        $allowedrolles = ['admin', 'user'];
        if ( ! in_array($roll, $allowedrolles)){
            return false;
        }
        return true;
    }
}