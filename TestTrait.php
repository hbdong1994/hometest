<?php
require 'trait_test.php';

class TestTrait {
    use TestThisTrait;
    public $data;
    public function __construct()
    {
        $this->data = 'this is TestTrait\'s data';
    }

    public function getData()
    {
        $this->showWhere(); //调用trait内的显示方法
    }
}


$test = new TestTrait();

$test->getData();