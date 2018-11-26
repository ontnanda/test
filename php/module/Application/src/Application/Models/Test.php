<?php
namespace Application\Models;

 
class Test
{ 
    protected $users; 
	function __construct() 
    {
       
    } 
 
    function test1($n)
    {
        $n = (int) $n;
        return pow(2, $n) - pow(-1, ceil($n/3));
    }

    function test2($n)
    {
        return $n - 24  - 20;
    }

    function test3($n, &$ret )
    {
        $n = (int) $n;
        if($n <= 1){
            $ret =  5;
            return;
        }
        $ret += $n * pow(10, $n -1) + $this->test3($n-1, $ret);
    }
}
    