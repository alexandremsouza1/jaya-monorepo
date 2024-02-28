<?php

use Tests\TestCase;
use Illuminate\Console\Scheduling\Schedule;
use App\Console\Kernel;

class KernelTest extends TestCase
{
    public function testScheduleMethod()
    {
        /** @var \Illuminate\Console\Scheduling\Schedule $schedule */
        $schedule = app()->make(\Illuminate\Console\Scheduling\Schedule::class);

        $events = collect($schedule->events())->filter(function (\Illuminate\Console\Scheduling\Event $event) {
            return stripos($event->command, 'YourCommandHere');
        });

        // if ($events->count() == 0) {
        //     $this->fail('No events found');
        // }

        // $events->each(function (\Illuminate\Console\Scheduling\Event $event) {
        //     // This example is for hourly commands.
        //     $this->assertEquals('0 * * * * *', $event->expression);
        // });

        $this->assertInstanceOf('Illuminate\Support\Collection',$events);
    }
}
