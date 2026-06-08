<?php

namespace App\Console\Commands;

use App\Models\Blog;
use Illuminate\Console\Command;

class PublishScheduledBlogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blogs:publish-scheduled';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish scheduled blogs';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Blog::where('status', 2)
            ->where('published_at', '<=', now())
            ->update([
                'status' => 1,
            ]);

        $this->info('Scheduled blogs published.');
    }
}
