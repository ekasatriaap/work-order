<?php

if (!function_exists('accountLogin')) {
  function accountLogin()
  {
    return auth()->user();
  }
}

if (!function_exists('userIsRoot')) {
  function userIsRoot()
  {
    return accountLogin()->is_root == ROOT_USER;
  }
}
