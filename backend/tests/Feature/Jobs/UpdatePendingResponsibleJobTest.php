<?php


namespace Tests\Feature\Jobs;

use Illuminate\Support\Facades\Queue;
use App\Jobs\UpdateClientsJob;
use App\Jobs\UpdatePendingResponsibleJob;
use App\Services\ResponsibleService;
use Tests\TestCase;

class UpdatePendingResponsibleJobTest extends TestCase
{


    //vendor/bin/phpunit --filter testUpdatePendingResponsibleJobTestDispatchesCorrectly tests/Feature/Jobs/UpdatePendingResponsibleJobTest.php
    public function testUpdatePendingResponsibleJobTestDispatchesCorrectly()
    {

        $responsibleService = app(ResponsibleService::class);

        $job = (new \App\Jobs\UpdatePendingResponsibleJob($responsibleService));

        dispatch($job);


        Queue::assertPushed(UpdatePendingResponsibleJob::class, function ($job) use ($responsibleService) {
            return $job->responsibleService === $responsibleService;
        });
    }
}
