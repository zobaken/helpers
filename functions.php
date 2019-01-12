<?php

/**
 * Generate random base32 string
 * @param int $len Length (optional)
 * @return string
 */
function uid($len = 24) {
    $res = '';
    while(strlen($res) < $len) {
        $res .= base_convert(mt_rand(), 10, 32);
    }
    return substr($res, 0, $len);
}

/**
 * Generate random integer
 * @return int
 */
function uint() {
    return mt_rand() << 16 | time();
}

// Some common functions

/**
 * Get associative array of objects
 * @param array $array Array of objects
 * @param string $key Object property used for array key
 * @return array
 */
function associate(array $array, $key)
{
    $result = [];
    foreach ($array as $obj) {
        if (is_object($obj) && isset($obj->$key) && $obj->$key !== null) {
            $result[$obj->$key] = $obj;
        } elseif (is_array($obj) && isset($obj[$key]) && $obj[$key] !== null) {
            $result[$obj[$key]] = $obj;
        }
    }
    return $result;
}

/**
 * Get array of fields from array of objects
 * @param array $array
 * @param string $field
 * @return array
 */
function column(array $array, $field)
{
    $res = array();
    foreach ($array as $r) {
        if (is_object($r) && !empty($r->$field)) {
            $res []= $r->$field;
        } elseif (is_array($r) && !empty($r[$field])) {
            $res []= $r[$field];
        }
    }
    return $res;
}

/**
 * Return time in database format
 * @param mixed $time Integer time or string date of nothing (for current time)
 * @return string
 */
function dbtime($time = false) {
    if (is_string($time)) {
        $time = strtotime($time);
    }
    return $time ? date('Y-m-d H:i:s', $time) : date('Y-m-d H:i:s');
}

/**
 * Return date in database format
 * @param mixed $time Integer time or string date of nothing (for current time)
 * @return string
 */
function dbdate($time = false) {
    if (is_string($time)) {
        $time = strtotime($time);
    }
    return $time ? date('Y-m-d', $time) : date('Y-m-d');
}
