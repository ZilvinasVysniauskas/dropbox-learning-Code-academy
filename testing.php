<?php
$load = 'root-1';
$load = strrev($load);
while (strrev($load) !== 'root-1'){
    $index = strpos($load, '-');
    $load = substr($load, $index + 1, strlen($load) - 1);
    $select[] = strrev($load);
}
