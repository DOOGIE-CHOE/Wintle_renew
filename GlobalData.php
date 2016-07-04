<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 7/5/2016
 * Time: 1:57 AM
 */


// not using it yet. :)
// using example below
// $test = new Property();
// $test->anyvariablename = 'a';
// echo $test->anyvariablename;
// >> a


class Property{

    static private $data = array();

    public function __set($name, $value){
        echo "Setting '$name' to '$value'\n";
        $this->data[$name] = $value;
    }

    public function __get($name){
        return $this->data[$name];
    }
}

?>