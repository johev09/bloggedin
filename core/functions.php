<?php

function config($key, $value = null) {

  static $_config = array();

  if ($key === 'source' && file_exists($value))
    $_config = parse_ini_file($value, true);
  else if ($value == null)
    return (isset($_config[$key]) ? $_config[$key] : null);
  else
    $_config[$key] = $value;
}

