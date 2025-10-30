<?php

$base_dir = realpath(__DIR__ . '/..');
$phar_file = $base_dir . '/checksum.phar';

if (file_exists($phar_file)) {
    unlink($phar_file);
}

$phar = new Phar($phar_file);

$addDirs = ['src', 'bin', 'vendor'];

foreach ($addDirs as $dir) {
    $path = $base_dir . '/' . $dir;

    if (!is_dir($path)) continue;

    $it = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS)
    );

    foreach ($it as $file) {
        $local_path = str_replace($base_dir . '/', '', $file->getPathname());
        $phar->addFile($file->getPathname(), $local_path);
    }
}

$stub = <<<'STUB'
#!/usr/bin/env php
<?php
Phar::mapPhar('checksum.phar');
require 'phar://checksum.phar/vendor/autoload.php';
require 'phar://checksum.phar/bin/cli.php';
__HALT_COMPILER();
STUB;

$phar->setStub($stub);

exec('chmod +x ' . escapeshellarg($phar_file));