<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

/*
function doit($a, $b) {
    echo $a.'--'.$b.PHP_EOL;
    echo $a % $b;
    Echo PHP_EOL;
    return ($b == 0) ? $a : doit($b, $a % $b);
}
echo doit(1071, 1029); // 21



$test_array = array("first_key" => "first_value",
    "second_key" => "second_value");
array_walk($test_array, function(&$a, $b) { $a = "$b loves $a"; });
var_dump($test_array);*/

/*
function countWords2($string)
{
    $arr = explode(' ', $string);
    $func = function($char) {
        $char2 = trim($char);
        if($char2) {
            return $char2;
        }
    };
    return count(array_filter((array_map($func, $arr))));
}

function countWords($string)
{
    $counter = 0;
    for ($i=0; $i < strlen($string); $i++) {
        if(trim($string[$i]) && !trim($string[$i+1])) {
            $counter++;
        }
    }
    return $counter;
}

echo countWords(" I   like coding  adfadsf ");
*/

function array_column($array, $column){
    echo"!!!!!"; exit();
    $a2 = array();
    array_map(function ($a1) use ($column, &$a2){
        array_push($a2, $a1[$column]);
    }, $array);
    return $a2;
}

Class Sudoku
{
    protected $_lines;
    protected $_arr;
    public function sudokuCheck($arr)
    {
        $this->_lines = count($arr);
        if ($this->_lines != count($arr[0])) {
            throw new Exception('wrong input.');
        }
        $this->_arr = $arr;
        $result = false;
        if ($this->_checkRows() && $this->_checkColumns() && $this->_checkBoxes())
            $result = true;
        return $result;
    }
    protected function _checkRows()
    {
        $result = true;
        for ($i = 0; $i < $this->_lines; $i++) {
            if (!$this->_compareWithDefault($this->_arr[$i])) {
                $result = false;
                break;
            }
        }
        return $result;
    }
    protected function _checkColumns()
    {

        $result = true;
        for ($i = 0; $i < $this->_lines; $i++) {
            echo PHP_EOL;
            if (!$this->_compareWithDefault($this->array_column($this->_arr, $i))) { //for PHP 5.5+ array_column()
                $result = false;
                break;
            }
        }
        return $result;
    }
    protected function _checkBoxes()
    {
        $result = true;
        for ($i = 0; $i < $this->_lines; $i= $i+3) {
            $arr1 = array_slice($this->_arr, $i, 3);
            $arr2 = array();
            for ($j = 0; $j < $this->_lines; $j++) {
                array_push($arr2, $arr1[0][$j]);
                array_push($arr2, $arr1[1][$j]);
                array_push($arr2, $arr1[2][$j]);
                if (!(($j+1)%3)) {
                    if (!$this->_compareWithDefault($arr2)) {
                        sort($arr2);
                        $result = false;
                        break 2;
                    }
                    $arr2 = array();
                }
            }
        }
        return $result;
    }
    private function array_column($array, $column)
    {
        $a2 = array();
        array_map(function ($a1) use ($column, &$a2) {
            array_push($a2, $a1[$column]);
        }, $array);
        return $a2;
    }
    private function _compareWithDefault($array) {
        sort($array);
        return array(1,2,3,4,5,6,7,8,9) == $array;
    }
}


$array = array(
    array(1,2,3,4,5,6,7,8,9),
    array(4,5,6,7,8,9,1,2,3),
    array(7,8,9,1,2,3,4,5,6),
    array(2,3,4,5,6,7,8,9,1),
    array(5,6,7,8,9,1,2,3,4),
    array(8,9,1,2,3,4,5,6,7),
    array(3,4,5,6,7,8,9,1,2),
    array(6,7,8,9,1,2,3,4,5),
    array(9,1,2,3,4,5,6,7,8)
);

$s = new Sudoku();
var_dump($s->sudokuCheck($array));



