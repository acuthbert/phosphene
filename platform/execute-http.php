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
 * execute-http.php is the entry point for all HTTP requests for Rhubarb applications.
 * The only exceptions to this are when webserver URL rewriting goes directly to
 * a resource for performance reasons, e.g. accessing static content like images
 * and CSS files.
 */

use Rhubarb\Crown\Logging\Log;
use Rhubarb\Crown\Module;

// Change the working directory to the top level project folder.
chdir(__DIR__ . "/../../../../");

// Initiate our bootstrap script to boot all libraries required.
require_once __DIR__ . "/boot.php";

require_once __DIR__ . "/../src/Logging/Log.php";
require_once __DIR__ . "/../src/Module.php";
require_once __DIR__ . "/../src/Context.php";

Log::performance( "Rhubarb booted", "ROUTER" );

$request = \Rhubarb\Crown\Context::currentRequest();

try {
    // Pass control to the Module class and ask it to generate a response for the
    // incoming request.
    $response = Module::generateResponseForRequest($request);
    Log::performance( "Response generated", "ROUTER" );
    $response->send();
    Log::performance( "Response sent", "ROUTER" );
} catch (\Exception $er) {
    $context = new \Rhubarb\Crown\Context();

    if ($context->DeveloperMode) {
        Log::error($er->getMessage(), "ERROR");

        print "<pre>Exception: " . get_class($er) . "
Message: " . $er->getMessage() . "
Stack Trace:
" . $er->getTraceAsString();

    }
}

Log::debug("Request Complete", "ROUTER");