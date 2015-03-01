<?php

use vendor\befew\Logger;

/**
 * Dump
 *
 * @param $var
 * @param bool $die
 */
function d($var, $die = true) {
    Logger::debug($var, $die);
}
