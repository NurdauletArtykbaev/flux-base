<?php

namespace Nurdaulet\KzSmsProvider\Commands;

use Illuminate\Console\Command;

class SmsPublishCommand extends Command
{
    public $signature = 'sms_kz:publish';

    public $description = 'Publish sms kz config file';

    public function handle()
    {
        $this->call('vendor:publish', ['--tag' => 'sms-kz-config']);
    }
}
