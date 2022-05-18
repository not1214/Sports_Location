<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class ChangeStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'change:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '募集ステータスの変更';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Log::info('TESTです。');

        $events = Event::all();
        foreach ($events as $event) {
            $number = Reservation::where('event_id', $event->id)->count();
            if ($event->deadline < Carbon::now() || $event->number <= $number) {
                $event->status = 0;
                $event->save();
            }
        }
    }
}
