<?php

require_once __DIR__ . '/../vendor/autoload.php';

use function fatalus\ChecksumChecker\error;
use function fatalus\ChecksumChecker\success;

$file = $argv[1];
$checksum = $argv[2];

checkFile($file, $checksum);

function checkFile (string $fp, string $checksum)
{
    $fp = trim($fp);

    if (!is_file($fp) || !is_readable($fp)) {
        error("File not found or not readable: $fp");
    }

    $checksum = explode(':', trim($checksum));

    //determine algorithm and default to sha256 if not found
    $algorithm = in_array(strtolower($checksum[0]), hash_algos())
        ? $checksum[0]
        : 'sha256';

    $calculated_checksum = hash_file($algorithm, $fp);

    if ($calculated_checksum === $checksum[1]) {
        success("Checksum matches for file: $fp");
    } else {
        error("Checksum does not match for file: $fp");
    }
}