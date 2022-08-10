<?php

namespace Tests;

use App\Models\CmsPage;
use App\Models\Country;
use App\Models\Dealer;
use App\Models\DealerShop;
use App\Models\Faq;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

trait UtilityTestTrait
{
    use WithFaker;
    public function truncateTables(array $tableNames = []): void
    {
        if (0 == count($tableNames)) {
            $tableNames = Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();
        }

        DB::statement("SET foreign_key_checks=0");
        foreach ($tableNames as $tableName) {
            if ($tableName == 'migrations') {
                continue;
            }
            DB::table($tableName)->truncate();
        }

        DB::statement("SET foreign_key_checks=1");
    }

    public function getCountry($code='in'){
        $country = Country::where('code',$code)->first();
        return $country;
    }
    // creare specific user
    public function createUser(){
        
        $user = User::updateOrCreate([
            'email' => 'rinkal.j@yudiz.com',
        ],[
            'custom_id' => getUniqueString('users'),
            'first_name' => 'rinkal',
            'last_name' => 'patel',
            'email' => 'rinkal.j@yudiz.com',
            'country_code' => $this->getCountry()->code,
            'contact_no' => '112345678',
            'password' => Hash::make('12345678'),
            'confirm_password' => Hash::make('12345678'),
        ]);
        return $user;
    }
    // create fake user
    public function createFakerUser($args = []){
        
        return [
            'custom_id' => getUniqueString('users'),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            "contact_no" => $this->faker->numberBetween('900000','999999999999'),
            "country_code" => $this->getCountry()->phonecode,
            'password' => '12345678',
            'confirm_password' => '12345678',
        ];
        
    }
    public function getUser($fieldname = null ,$value = null){
        if(!empty($value) && !empty($fieldname)){
            $user = User::where($fieldname,$value)->firstOrFail();
        }
        else{
            $user = User::firstOrFail();
        }
        return $user;
    }

    public function createDealer(){
        
        $user = Dealer::updateOrCreate([
            'email' => 'rinkal.j@yudiz.com',
        ],[
            'custom_id' => getUniqueString('dealers'),
            'first_name' => 'rinkal',
            'last_name' => 'patel',
            'email' => 'rinkal.j@yudiz.com',
            'country_code' => $this->getCountry()->code,
            'contact_no' => '112345678',
            'password' => Hash::make('12345678'),
            'confirm_password' => Hash::make('12345678'),
        ]);
        $usd_code = getUniqueDigitsCode('dealer_shops','usd_qr_code');
        $cdf_code = getUniqueDigitsCode('dealer_shops','cdf_qr_code');
        $shop = DealerShop::create([
            'custom_id' => getUniqueString('dealer_shops'),
            'dealer_id' => $user->id, 
            'name' => 'Shop 1',
            'address' => 'Shop address detail', 
            'usd_qr_url' => Config::get('app.url').'/usd/'.$usd_code, 
            'cdf_qr_url' => Config::get('app.url').'/usd/'.$cdf_code, 
            'usd_qr_code' => $usd_code, 
            'cdf_qr_code' => $cdf_code
        ]);
        return $user;
    }

    public function getCmsPage(){
        return CmsPage::first();
    }

    public function createFaq(){
        $faq = Faq::create([
            'custom_id' => getUniqueString('faqs'),
            'question' => $this->faker->sentence(),
            'answer' => $this->faker->sentence(),
        ]);
        return $faq;
    }

    protected function setUserToken($user=null){
        if($user!=null){
            $token = $user->createToken(config('utility.token'))->plainTextToken;
            $this->withHeader('Authorization', 'Bearer ' . $token);
        }
        else{
            $user = $this->createUser();
            $token = $user->createToken(config('utility.token'))->plainTextToken;
            $this->withHeader('Authorization', 'Bearer ' . $token);
        }
        
        return $token;
    }

    protected function setDealerToken($dealer=null){
        if($dealer!=null){
            $token = $dealer->createToken(config('utility.token'))->plainTextToken;
            $this->withHeader('Authorization', 'Bearer ' . $token);
        }
        else{
            $this->createDealer();
            $dealer= Dealer::latest()->first();
            $token = $dealer->createToken(config('utility.token'))->plainTextToken;
            $this->withHeader('Authorization', 'Bearer ' . $token);
        }
        
        return $token;
    }
}
