<?php

if (Phar::running() !== '') {
    require 'phar://' . basename(Phar::running()) . '/vendor/autoload.php';
} else {
    require __DIR__ . '/../vendor/autoload.php';
}

if (!function_exists('fatalus\\ChecksumChecker\\error')) {
    if (Phar::running() !== '') {
        require 'phar://' . basename(Phar::running()) . '/src/functions.php';
    } else {
        require __DIR__ . '/../src/functions.php';
    }
}

require __DIR__ . '/../src/checksum-checker.php';
