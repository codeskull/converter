<?php

namespace Converter\File;

use Converter\Result;

/**
 * Reads the config
 * @param string $path
 * @return callable result
 */
function read($path)
{
    if (!file_exists($path)) {
        return Result\error("File not found: $path");
    }

    if (!is_file($path)) {
        return Result\error("$path is not a file");
    }

    if (!is_readable($path)) {
        return Result\error('Permission denied');
    }

    $result = file_get_contents($path);

    return $result !== false
        ? Result\success($result)
        : Result\error("Couldn't read $path");
}

/**
 * Writes the config
 * @param string $path
 * @param string $content
 * @return callable result
 */
function write($path, $content)
{
    if (!is_writable(dirname($path))) {
        return Result\error("$path is not writable");
    }

    $result = file_put_contents($path, $content);

    return $result !== false
        ? Result\success($result)
        : Result\error("Couldn't write to $path");
}
