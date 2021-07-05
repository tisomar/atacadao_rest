<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$url_base="http://localhost/api/";

$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

$registros_por_pagina = 5;

$numero_registro = ($registros_por_pagina * $pagina) - $registros_por_pagina;
