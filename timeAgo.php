<?php
/**
 * Created by PhpStorm.
 * User: raj
 * Date: 7/20/2020
 * Time: 1:53 PM
 */


function getTime($time){
    $time_difference = time() - $time;
    if($time_difference < 1){
        return 'less than 1 sec ago';
    }

    $condition = array(12 * 30 * 24 * 60 * 60);

}