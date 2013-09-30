<?php
date_default_timezone_set('PRC');
$t = microtime(true);
$micro = sprintf("%06d",($t - floor($t)) * 1000000);
$d = new DateTime( date('Y-m-d H:i:s.'.$micro,$t) );
$fileName = $d->format("Ymd_His_u");

echo $fileName;