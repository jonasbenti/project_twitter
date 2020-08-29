<?php

class InitList
{
    private $html;

    public function __construct()
    {
        $this->html = file_get_contents('html/list_init.html');
    }

   
    public function show()
    {
       
        echo $this->html;
    }


}
