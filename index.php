<?php

require 'vendor/autoload.php';

define('URL', '/blog');

$connect = new App\Database\Connect('localhost', 'comments', 'root', 'root');
