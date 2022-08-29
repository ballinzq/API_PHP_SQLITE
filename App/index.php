<?php
namespace App;

header('Content-Type: application/json; charset=utf-8');
require_once("../vendor/autoload.php");

use App\Connection;

$pdo = (new Connection())->connect();


