<?php

require_once 'Make.php';

if($argc > 2){
    //Next explode very next argument by ':'
    // Then verify both portion
    $make_argument = explode(':',$argv[1]);
    if($make_argument[0] == 'make' && !empty($make_argument[1])){
        $class_type = strtolower($make_argument[1]);
        $available_class = ['controller','model'];
        $class_name = $argv[2];
        if(in_array($class_type,$available_class)){
            $make = new Make();
            echo $make->request($class_name,$class_type);
//            echo "got it\n";
        }else{
            echo "Currently Unavailable\n";
            exit;
        }
    }else{
        echo "\nInvalid Argument\n";
        echo "\n\n====== Available Command =========\n";
        echo "php fast make:controller \t[controllername]\n";
        echo "php fast make:model \t\t[modelname]\n";
        echo "==================================\n\n";
        exit;
    }
}else{
    echo "\nNot Enough Arguments\n";
    echo "\n====== Available Command =========\n";
    echo "php fast make:controller \t[controllername]\n";
    echo "php fast make:model \t\t[modelname]\n";
    echo "==================================\n\n";
}