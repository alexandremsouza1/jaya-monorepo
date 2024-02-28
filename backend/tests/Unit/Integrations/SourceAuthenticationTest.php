<?php


use App\Integrations\SourceAuthentication;
use Tests\TestCase;


class SourceAuthenticationTest extends TestCase
{
    protected $source;

    protected function setUp(): void
    {
        parent::setUp();
        $this->source = new SourceAuthentication();
    }


    //vendor/bin/phpunit --filter testIsKonnectUser tests/Unit/Integrations/SourceAuthenticationTest.php
    public function testIsKonnectUser()
    {
        $document = '08114367000148';
        $email = 'mklanhouse@hotmail.com';
        $result = $this->source->isKonnectUser($document, $email);
        $this->assertSame(false, $result);
    }
}