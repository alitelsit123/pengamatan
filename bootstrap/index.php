<?php
require_once('v/DB.php');
require_once('d/DataPengamatan.php');
require_once('r/layout.php');


// print_r(getAll());
render($_GET['v'] ?? null);