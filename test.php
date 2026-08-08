<?php

$dir = __DIR__ . '/bootstrap/cache';

echo "Directory: $dir\n";
echo "Exists: ";
var_dump(is_dir($dir));

echo "Writable: ";
var_dump(is_writable($dir));