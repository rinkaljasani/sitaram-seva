<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use UtilityTestTrait;

    public function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
        $this->withHeader('Accept', 'application/json');
        $this->withHeader('x-language', config('utility.default_lang_code'));
        $this->truncateTables(['users','dealers','dealer_shops']);
        // $this->artisan('migrate:fresh');
        // $this->artisan('db:seed');
    }

    protected function getVersion()
    {
        return "v.1.0";
    }
    protected function getLanguage()
    {
        return "en";
    }

}
