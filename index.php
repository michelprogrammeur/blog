<?php
session_start();
require 'vendor/autoload.php';

define('URL', '/blog');

$connect = new App\Database\Connect('localhost', 'comments', 'root', 'root');

require_once 'src/Router/Router.php';