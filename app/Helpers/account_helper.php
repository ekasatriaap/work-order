<?php
if (!function_exists('activeGuard')) {
  function activeGuard()
  {
    if (auth()->guard('user')->check()) {
      return 'user';
    }

    return null;
  }
}

if (!function_exists('accountLogin')) {
  function accountLogin()
  {
    return auth(activeGuard())->user();
  }
}

if (!function_exists('accountIsRoot')) {
  function accountIsRoot()
  {
    return accountLogin()->is_root == ROOT_USER;
  }
}
