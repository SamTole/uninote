<?php

require 'config.php';

session_set_cookie_params(0, "$path");
session_start();

$sid = session_id();
echo "Session on $path started with session id: $sid.";

?>