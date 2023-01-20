<?php

session_start();
setcookie('id', "", time() - 60 * 60);
setcookie('key', "", time() - 60 * 60);
session_destroy();

header("Location: login.php");