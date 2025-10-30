<?php

namespace fatalus\ChecksumChecker;

use function Termwind\render;

function error(string $message): void
{
    render("<div>
        <div class=\"px-1 bg-red-600\">Error</div>
        <em class=\"ml-1\">
            $message
        </em>
    </div>");
    exit(1);
}

function success(string $message): void
{
    render("<div>
        <div class=\"px-1 bg-green-600\">Success</div>
        <em class=\"ml-1\">
            $message
        </em>
    </div>");
    exit(0);
}