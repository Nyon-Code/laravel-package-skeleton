<?php

namespace Vendor\LaralvePackageSkeleton\Commands;

use Illuminate\Console\Command;

class SkeletonCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'skeleton';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Indicates whether the command should be shown in the Artisan command list.
     *
     * @var bool
     */
    protected $hidden = false;

    /**
     * The console command name aliases.
     *
     * @var array
     */
    protected $aliases = ['skltn'];

    /**
     *
     *
     * @var string
     */
    protected string $alias = 'skltn';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Hello world');
    }
}
