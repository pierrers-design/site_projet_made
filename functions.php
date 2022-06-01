<?php

// Recursive Glob function ; Does not support flag GLOB_BRACE
function rglob($pattern, $flags = 0)
{
  $content = glob($pattern, $flags);
  foreach (glob(dirname($pattern) . '/*', GLOB_ONLYDIR | GLOB_NOSORT) as $dir) {
    $content = array_merge($content, rglob($dir . '/' . basename($pattern), $flags));
  }
  return $content;
}
