<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Usage counters older than the admin page can show are only clutter; there
// is no scheduler on the hosts, so run this from cron or by hand.
Artisan::command('analytics:prune {--days=400 : keep this many days}', function () {
    $deleted = \App\Support\Metrics::prune(max(90, (int) $this->option('days')));
    $this->info("Deleted {$deleted} counter rows.");
})->purpose('Delete usage-analytics counters older than --days (at least 90)');
