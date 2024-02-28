<?php

namespace App\Console;

use App\Integrations\Source;
use App\Jobs\SendNotificationsJob;
use App\Jobs\UpdateClientsJob;
use App\Jobs\UpdatePaymentConditionJob;
use App\Jobs\UpdatePendingResponsibleJob;
use App\Models\RegisterNotifications;
use App\Repositories\NotificationCampaignMessagesRepository;
use App\Repositories\NotificationRepository;
use App\Repositories\RegisterNotificationsRepository;
use App\Repositories\SendListContactsRepository;
use App\Repositories\SendListRepository;
use App\Services\ClientService;
use App\Services\NotificationService;
use App\Services\OneSignalService;
use App\Services\ResponsibleService;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $sourceWsdl = app(Source::class);

            $job = new UpdateClientsJob();
            $job->handle($sourceWsdl);
        })->name('updateClients')->withoutOverlapping(300)->hourly();

        $schedule->call(function () {
            $sourceWsdl = app(Source::class);
            $clientService = app(ClientService::class);

            $job = new UpdatePaymentConditionJob($sourceWsdl, $clientService);
            $job->handle();
        })->name('updatePaymentCondition')->withoutOverlapping(3600)->everyOddHour();

        $schedule->call(function () {
            try {
                $notificationService = app(NotificationService::class);
                $notificationRepository = app(NotificationRepository::class);
                $sendListRepository = app(SendListRepository::class);
                $sendListContactsRepository= app(SendListContactsRepository::class);
                $notificationCampaignMessagesRepository = app(NotificationCampaignMessagesRepository::class);
                $registerNotificationsRepository = app(RegisterNotificationsRepository::class);
                $oneSignalService = app(OneSignalService::class);

                $job = new SendNotificationsJob($notificationService, $notificationRepository, $sendListRepository, $sendListContactsRepository, $notificationCampaignMessagesRepository, $registerNotificationsRepository, $oneSignalService);
                $job->handle();
            } catch(\Exception $exception) {
                error_log($exception->getMessage());
            }

        })->name('sendNotifications')->withoutOverlapping(300)->everyMinute();

        $schedule->call(function () {
            $responsibleService = app(ResponsibleService::class);

            $job = new UpdatePendingResponsibleJob($responsibleService);
            $job->handle();
        })->name('updatePendingResponsible')->withoutOverlapping(300)->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
