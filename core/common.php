<?php
        
use Config;
use Cache;
use core\Model\Model;
use core\Common\StaticTookit;
// function D($name) {

//     static $_model = array();

//     $names = explode(".", $name);
//     $className = "";

//     if(count($names) == 2) {
//         $className = "src\\Model\\{$names[0]}\\{$names[1]}Model";
//     }

//     if (!class_exists($className)) {
//         throw new Exception("Class ".$className." not found !");
//     }

//     if (!isset($_model[$names[1]]))
//         $_model[$names[1]] = new $className();

//     return $_model[$names[1]];

// }
function D($name='', $app='pet_') {
    $_model = StaticTookit::get('_model', []);
    if (empty($name))
        return new Model;
    if (isset($_model[$app . $name])) return $_model[$app . $name];
    $OriClassName = $name;
    if (strpos($name, '.')) {
        $array = explode('.', $name);
        $name = array_pop($array);
        $className = $name . 'Model';
        $classNamePath = implode('.', $array) . '/' . $name . 'Model.php';
        require_cache(__ROOT__.'src/Model/'.$classNamePath);
    } else {
        $className = $name . 'Model';
        $classNamePath = $name . 'Model.php';
        require_cache(__ROOT__.'src/Model/'.$classNamePath);
    }
    if (class_exists($className)) {
        $model = new $className();
    } else {
        $model = new Model($name);
    }
    $_model[$app . $OriClassName] = $model;
    StaticTookit::set('_model', $_model);
    return $model;
}

function M($name='', $class='Model') {
    $_model = StaticTookit::get('_model', []);
    if (!isset($_model[$name])) {
        $_model[$name] = new $class($name);
        StaticTookit::set('_model', $_model);
    }
    return $_model[$name];
}

// 全局缓存设置和读取
function S($name, $value='', $expire='', $type='') {
    $_cache = StaticTookit::get('_cache', []);
    //取得缓存对象实例
    $cache = Cache::getInstance($type);
    if ('' !== $value) {
        if (is_null($value)) {
            // 删除缓存
            $result = $cache->rm($name);
            if ($result) {
                unset($_cache[$type . '_' . $name]);
                StaticTookit::set('_cache', $_cache);
            }
            return $result;
        }else {
            // 缓存数据
            $cache->set($name, $value, $expire);
            $_cache[$type . '_' . $name] = $value;
            StaticTookit::set('_cache', $_cache);
        }
        return;
    }
    if (isset($_cache[$type . '_' . $name]))
        return $_cache[$type . '_' . $name];
    // 获取缓存数据
    $value = $cache->get($name);
    $_cache[$type . '_' . $name] = $value;
    StaticTookit::set('_cache', $_cache);
    return $value;
}

function C($name) {

    return Config::get("app::{$name}");
}

function L($name) {

    return Config::get("language::{$name}");
}

// 设置和获取统计数据
function N($key, $step=0) {
    static $_num = array();
    if (!isset($_num[$key])) {
        $_num[$key] = 0;
    }
    if (empty($step))
        return $_num[$key];
    else
        $_num[$key] = $_num[$key] + (int) $step;
}

// 记录和统计时间（微秒）
function G($start, $end = '', $dec = 3) {
    static $_info = array();
    if (!empty($end)) {// 统计时间
        if (!isset($_info[$end])) {
            $_info[$end] = microtime(TRUE);
        }
        return number_format(($_info[$end] - $_info[$start]), $dec);
    } else {// 记录时间
        $_info[$start] = microtime(TRUE);
    }
}

// 取得对象实例 支持调用类的静态方法
function get_instance_of($name, $method='', $args=array()) {
    static $_instance = array();
    $identify = empty($args) ? $name . $method : $name . $method . to_guid_string($args);
    if (!isset($_instance[$identify])) {
        if (class_exists($name)) {
            $o = new $name();
            if (method_exists($o, $method)) {
                if (!empty($args)) {
                    $_instance[$identify] = call_user_func_array(array(&$o, $method), $args);
                } else {
                    $_instance[$identify] = $o->$method();
                }
            }
            else
                $_instance[$identify] = $o;
        }
        else
            halt(L('_CLASS_NOT_EXIST_') . ':' . $name);
    }
    return $_instance[$identify];
}

// 根据PHP各种类型变量生成唯一标识号
function to_guid_string($mix) {
    if (is_object($mix) && function_exists('spl_object_hash')) {
        return spl_object_hash($mix);
    } elseif (is_resource($mix)) {
        $mix = get_resource_type($mix) . strval($mix);
    } else {
        $mix = serialize($mix);
    }
    return md5($mix);
}

/**
 * from thinkphp
 * 字符串命名风格转换
 * type
 * =0 将Java风格转换为C的风格
 * =1 将C风格转换为Java的风格
 * @access protected
 * @param string $name 字符串
 * @param integer $type 转换类型
 * @return string
 */
function parse_name($name, $type=0) {
    if ($type) {
        return ucfirst(preg_replace_callback("/_([a-zA-Z])/",function ($m){ return strtoupper($m[1]); }, $name));
    } else {
        $name = preg_replace("/[A-Z]/", "_\\0", $name);
        return strtolower(trim($name, "_"));
    }
}

// 自定义异常处理
function throw_exception($msg, $type='Exception', $code=0) {
    throw new $type($msg, $code, true);
}

// 实例化model
function model($name, $params = array()) {
    return X($name, $params = array(), 'Model');
}

// 调用接口服务
function X($name, $params = array(), $domain = 'Service') {
    $_service = StaticTookit::get('_service', []);
    $app = 'bcy_';

    if (isset($_service[$domain . '_' . $app . '_' . $name]))
        return $_service[$domain . '_' . $app . '_' . $name];

    $class = $name . $domain;
    if (file_exists(__ROOT__ . "/src/" . $domain . '/' . $class . '.php')) {
        require_cache(__ROOT__ . "/src/" . $domain . '/' . $class . '.php');
    } else {
        require_cache(__ROOT__ . '/src/Other/' . $domain . '/' . $class . '.php');
    }
    //服务不可用时 记录日志 或 抛出异常
    if (class_exists($class)) {
        $obj = new $class($params);
        $_service[$domain . '_' . $app . '_' . $name] = $obj;
        StaticTookit::set('_service', $_service);
        return $obj;
    } 
}

// 优化的require_once
function require_cache($filename) {
    static $_importFiles = array();
    $filename = realpath($filename);
    if (!isset($_importFiles[$filename])) {
        require $filename;
            $_importFiles[$filename] = true;
    }
    return $_importFiles[$filename];
}

/**
 * 获取字符串的长度
 *
 * 计算时, 汉字或全角字符占2个长度, 英文字符占1个长度
 * @param string  $str
 * @param boolean $filter 是否过滤html标签
 * @return int 字符串的长度
 */
function get_str_length($str, $filter = false) {
    if ($filter) {
        $str = html_entity_decode($str, ENT_QUOTES);
        $str = strip_tags($str);
    }
    return (strlen($str) + mb_strlen($str, 'UTF8')) / 2;
}
//getShort会清理掉所有的样式
function getShort($str, $length = 40, $ext = '&hellip;') {
    $str = strip_tags($str);
    $str = htmlspecialchars($str);
    $strlenth = 0;
    $output = '';
    preg_match_all("/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/", $str, $match);
    foreach ($match[0] as $v) {
        preg_match("/[\xe0-\xef][\x80-\xbf]{2}/", $v, $matchs);
        if (!empty($matchs[0])) {
            $strlenth += 1;
        } elseif (is_numeric($v)) {
            $strlenth += 0.545;
        } else {
            $strlenth += 0.475;
        }

        if ($strlenth > $length) {
            $output .= $ext;
            break;
        }

        $output .= $v;
    }
    $output = htmlspecialchars_decode($output);
    return $output;
}
