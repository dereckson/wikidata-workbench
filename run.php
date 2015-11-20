<?php

/**
 * Wikidata Workbench task runner
 */

///
/// Processing arguments
///

$STDERR = fopen('php://stderr', 'w+');

if ($argc < 2) {
    fwrite($STDERR, "Usage: $argv[0] <task to run>\n");
    exit(1);
}

if ($argc > 2) {
    fwrite($STDERR, "Ignoring extraneous arguments after the task name.");
}

///
/// Calling the task runner
///

require 'autoload.php';

\WikidataWorkBench\Tasks\TaskRunner::runTask($argv[1]);