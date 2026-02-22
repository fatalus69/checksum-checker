<?php

require_once __DIR__ . '/../vendor/autoload.php';

use function fatalus\ChecksumChecker\error;
use function fatalus\ChecksumChecker\success;

handleArguments($argv);

function handleArguments(array $args): void
{
    if (count($args) <= 1 || in_array('--help', $args) || in_array('-h', $args)) {
        echo "Usage: php checksum-checker.php <file> <checksum>".PHP_EOL;
        echo "Example: php checksum-checker.php /path/to/file.txt sha256:abcdef123456...".PHP_EOL;
        exit(0);
    }

    if (count($args) < 3) {
        error("Usage: php checksum-checker.php <file> <checksum>\nExample: php checksum-checker.php /path/to/file.txt sha256:abcdef123456...");
    }

    $file = $args[1];
    $checksum = $args[2];
   
    checkFile($file, $checksum);
}

function checkFile (string $fp, string $checksum)
{
    $fp = trim($fp);

    if (!is_file($fp) || !is_readable($fp)) {
        error("File not found or not readable: $fp");
    }

    if (!str_contains($checksum, ':')) {
        error("Unable to detect checksum. Please use the following format: <algo>:<hash>");
    }

    $checksum = explode(':', trim($checksum));

    //determine algorithm and default to sha256 if not known by php 
    $algorithm = in_array(strtolower($checksum[0]), hash_algos())
        ? $checksum[0]
        : 'sha256';

    $calculated_checksum = hash_file($algorithm, $fp);

    if ($calculated_checksum === $checksum[1]) {
        success("Checksum matches for file: $fp");
    } 

    error("Checksum does not match for file: $fp");
}
