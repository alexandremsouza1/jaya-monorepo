<?php


namespace Tests\Feature\Jobs;

use App\Integrations\Source;
use Illuminate\Support\Facades\Queue;
use App\Jobs\UpdateClientsJob;
use App\Services\ClientService;
use Tests\TestCase;

class UpdateClientsJobTest extends TestCase
{


    //vendor/bin/phpunit --filter testUpdateClientsJobDispatchesCorrectly tests/Feature/Jobs/UpdateClientsJobTest.php
    public function testUpdateClientsJobDispatchesCorrectly()
    {

        $sourceWsdl = app(Source::class);
        $clientService = app(ClientService::class);

        $job = (new \App\Jobs\UpdateClientsJob());

        dispatch($job);


        Queue::assertPushed(UpdateClientsJob::class, function ($job) use ($sourceWsdl, $clientService) {
            return $job->sourceWsdl === $sourceWsdl && $job->clientService === $clientService;
        });
    }
}
