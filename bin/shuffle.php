#!/usr/bin/env php
<?php

require __DIR__ . '/../vendor/autoload.php';

$directory = $argv[1] ?? '.';
$shuffler = new Zaw\SyntaxShuffler\SyntaxShuffler();
$shuffler->shuffleDirectory($directory);
