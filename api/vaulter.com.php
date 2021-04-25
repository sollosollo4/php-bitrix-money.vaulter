<?php


header('Content-type: application/json');

// апи якобы другого сайта для получения текущего (меняющегося при каждом запросе курса ДОЛЛАРА и ЕВРО)
if(isset($_GET['funct'])) 
{
    $funct = $_GET['funct'];

    // генератор случайного числа
    function make_seed()
    {
        list($usec, $sec) = explode(' ', microtime());
        return $sec + $usec * 1000000;
    }

    switch($funct)
    {
        case 'get_current_value_dollar':
        {
            srand(make_seed());
            $randvaldollar = rand(65, 72);
            exit(json_encode(array('success' => true, 'data' => array('value' => $randvaldollar), 'reason' => 'success')));
            break;
        }
        case 'get_current_value_euro':
        {
            srand(make_seed());
            $randvaleuro = rand(74, 94);
            exit(json_encode(array('success' => true, 'data' => array('value' => $randvaleuro), 'reason' => 'success')));
            break;
        }
        default: 
        {
            exit(json_encode(array('success' => false, 'reason' => 'method not found')));
        }
    }
}
else
{
    exit(json_encode(array('success' => false, 'reason' => 'method not found')));
}





?>