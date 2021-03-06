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

namespace Rhubarb\Crown\Email;

require_once __DIR__ . '/../Settings.php';

use Rhubarb\Crown\Context;
use Rhubarb\Crown\Settings;

/**
 * Container for some default properties for sending emails.
 *
 * @property EmailAddress $DefaultSender The default sender to use for all emails (unless set explicitly in the email classes)
 */
class EmailSettings extends Settings
{
    protected function initialiseDefaultValues()
    {
        parent::initialiseDefaultValues();

        $request = Context::currentRequest();
        $host = $request->Server("SERVER_NAME");

        $this->DefaultSender = new EmailAddress("donotreply@" . $host . ".com");
    }
}