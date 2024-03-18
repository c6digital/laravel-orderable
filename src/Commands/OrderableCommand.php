<?php

namespace C6Digital\Orderable\Commands;

use Illuminate\Console\Command;

class OrderableCommand extends Command
{
    public $signature = 'laravel-orderable';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
