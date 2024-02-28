<?php

namespace Tests\Feature\Services;

use App\Models\Client;
use Tests\TestCase;
use App\Services\ClientService;
use App\Repositories\ClientRepository;

class ClientServiceTest extends TestCase
{
    public function testGetStatusCnpj()
    {
        $clientData = [
            'clientId' => 1,
            'document' => '1234567890',
            'name' => 'Test Company',
            'ClientSituation' => [
                'hasNoDebt' => 1,
                'debt' => 0,
            ],
            'sector' => 'Test Sector',
            'status' => 'dbClient',
        ];

        $repository = new ClientRepository();
        $repository->store($clientData, 'clientId');

        $clientService = new ClientService($repository);

        $status = $clientService->getClientDocument('1234567890');

        $this->assertSame('dbClient', $status);
    }
    //vendor/bin/phpunit --filter testPersistClients tests/Feature/Services/ClientServiceTest.php
    public function testPersistClients()
    {
        $clients = [
            [
                'CLIENTE' => 1,
                'CNPJ' => '1234567890',
                'RAZAO_SOCIAL' => 'Test Company 1',
                'DIVIDA' => 10,
            ],
            [
                'CLIENTE' => 2,
                'CNPJ' => '9876543210',
                'RAZAO_SOCIAL' => 'Test Company 2',
                'DIVIDA' => 30,
            ],
        ];

        $model = new Client();
        $repository = new ClientRepository($model);

        $clientService = new ClientService($repository);
        $clientService->persistClient($clients, 'Test Sector');

        // Assert that the clients were properly stored in the repository
        $storedClient1 = $repository->findByKey('clientId', 1);
        $this->assertSame('Test Company 1', $storedClient1['name']);

        $storedClient2 = $repository->findByKey('clientId', 2);
        $this->assertSame('Test Company 2', $storedClient2['name']);
    }
}
