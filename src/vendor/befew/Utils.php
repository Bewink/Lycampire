<?php

namespace vendor\befew;

/**
 * Class Utils
 * @package vendor\befew
 */
class Utils {
    /**
     * @param $var
     * @param null $default
     * @param bool $secure
     * @return null|string
     */
    public static function getVar(&$var, $default = null, $secure = false) {
        if(!isset($var)) {
            return $default;
        } else if(empty($var)) {
            return $default;
        } else {
            if($secure) {
                return htmlspecialchars($var);
            } else {
                return $var;
            }
        }
    }

    /**
     * @param $query
     * @param $values
     * @return string
     */
    public static function getQueryWithValues($query, $values) {
        return strtr($query, array_map(function($v) {return '`' . $v . '`';}, $values));
    }

    /**
     * @param $needle
     * @param $haystack
     * @param $name
     * @return bool
     */
    public static function searchInAssociativeArray($needle, $haystack, $name) {
        foreach($haystack as $line) {
            if($line[$name] === $needle) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param $path
     * @return bool
     */
    public static function delete($path) {
        if (is_dir($path) === true) {
            $files = array_diff(scandir($path), ['.', '..']);

            foreach ($files as $file) {
                self::delete(realpath($path) . '/' . $file);
            }

            return rmdir($path);
        } else if (is_file($path) === true) {
            return unlink($path);
        }

        return false;
    }

    /**
     * @param $password
     * @param $salt
     * @return string
     */
    public static function cryptPassword($password, $salt) {
        return md5(md5(BEFEW_SECRET_TOKEN) . md5($password) . md5($salt));
    }
}