<?php

/*
 *	Copyright 2015 RhubarbPHP
 *
 *  Licensed under the Apache License, Version 2.0 (the "License");
 *  you may not use this file except in compliance with the License.
 *  You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 *  Unless required by applicable law or agreed to in writing, software
 *  distributed under the License is distributed on an "AS IS" BASIS,
 *  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *  See the License for the specific language governing permissions and
 *  limitations under the License.
 */

/**
 * A bootstrapper to setup the Rhubarb platform when running unit tests
 */

global $unitTesting;

$unitTesting = true;

// Change the working directory to the top level project folder.
chdir(__DIR__ . "/../../../../");

// Initiate our bootstrap script to boot all libraries required.
require_once __DIR__ . "/boot.php";

if (isset($argv[1])) {
    $script = $argv[1];
    /** @noinspection PhpIncludeInspection */
    include($script);
}