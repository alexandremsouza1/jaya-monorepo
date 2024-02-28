<?php

namespace Tests\Feature\Services;

use App\Integrations\Source;
use App\Integrations\SourceAuthentication;
use App\Models\Client;
use App\Models\Responsible;
use App\Repositories\ClientRepository;
use App\Repositories\ResponsibleRepository;
use App\Services\AuthenticationService;
use App\Services\ClientService;
use Tests\TestCase;
use Mockery;
use App\Services\ResponsibleService;

class ResponsibleServiceTest extends TestCase
{

  protected $service;


  protected function setUp(): void
  {
    parent::setUp();
    $responsibleRepository = new ResponsibleRepository(new Responsible());
    $clientRepository = new ClientRepository(new Client());
    $source = Mockery::mock(Source::class);
    $sourceAuthentication = Mockery::mock(SourceAuthentication::class);
    $clientService = new ClientService($clientRepository, $responsibleRepository, $source, $sourceAuthentication);
    $authenticationService = Mockery::mock(AuthenticationService::class); 
    $this->service = new ResponsibleService($responsibleRepository, $clientService, $authenticationService);
  }


  //vendor/bin/phpunit --filter testActiveResponsible tests/Feature/Services/ResponsibleServiceTest.php
  public function testActiveResponsible()
  {
    $document = '47085588000197';
    $responsible = $this->service->getByDocument($document);
    $result = $this->service->activeResponsible($responsible);
    $this->assertTrue($result);
  }
}
