<?php
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('America/Sao_Paulo');


$page_title = '';   
$page_content = '';

try {
    
    if (!$conn = new mysqli('localhost', 'root', '', 'application'))

        throw new Exception('Falha de conexão');

    
} catch (Exception $e) {
    
    die('Oooops! Falha na conexão com o banco de dados.<br>A falha obtida foi: ' . $e->getMessage());
}
$conn->query("SET NAMES utf8");
$conn->query('SET character_set_connection=utf8');
$conn->query('SET character_set_client=utf8');
$conn->query('SET character_set_results=utf8');
$conn->query('SET GLOBAL lc_time_names = pt_BR');
$conn->query('SET lc_time_names = pt_BR');

function get_age($birthdate)
{

    $age = 0;

    $birth_date = date('Y-m-d', strtotime($birthdate));

    list($byear, $bmonth, $bday) = explode('-', $birth_date);

    $age = date("Y") - $byear;

    if (date("m") < $bmonth) $age -= 1;

    elseif ((date("m") == $bmonth) && (date("d") <= $bday)) $age -= 1;

    return $age;
}

function debug($element, $pre = true, $stop = true)
{
    if ($pre) echo '<pre>';
    print_r($element);
    if ($pre) echo '</pre>';
    if ($stop) exit;
}
