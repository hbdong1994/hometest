<?php

trait TestThisTrait{
    //trait内的数据作用域为父级作用域
    public function showWhere()
    {
        //指针为引用此trait的类指针
        echo $this->data;//调用父级data属性
    }
}