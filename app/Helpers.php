<?php

function config($str, $default = '')
{
    try {
        $arr = explode('.', trim($str));
        $filePath = path('config') . $arr[0] . '.php';
        if (!file_exists($filePath)) {
            if (!empty($default)) {
                return $default;
            }

            throw new InvalidArgumentException("FILE($filePath) NOT FOUND");
        }

        $data = require($filePath);
        array_shift($arr);
        foreach ($arr as $dataKey)
        {
            if (!isset($data[$dataKey])) {
                if (!empty($default)) {
                    return $default;
                }

                throw new InvalidArgumentException("$dataKey NOT FOUND");
            }

            $data = $data[$dataKey];
        }

        return $data;
    } catch (\Exception $e) {
        echo "<pre>CALL " . __FUNCTION__ . "() ERROR: " . $e->getMessage() . "</pre>";
        exit();
    }
}

function path($str)
{
    $str = trim($str);
    switch ($str) {
        case '' :
        case 'root' :
            return ROOT_PATH;
            break;
        case 'app' :
            return APP_PATH;
            break;
        default :
            return ROOT_PATH . $str . '/';
    }
}

/**
 * 
 * 产生随机字符串，不长于32位
 * @param int $length
 * @return 产生的随机字符串
 */
function getNonceStr($length = 32) 
{
    $chars = "abcdefghijklmnopqrstuvwxyz0123456789";  
    $str ="";
    for ( $i = 0; $i < $length; $i++ )  {  
        $str .= substr($chars, mt_rand(0, strlen($chars)-1), 1);  
    } 
    return $str;
}
