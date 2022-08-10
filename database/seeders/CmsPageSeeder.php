<?php

namespace Database\Seeders;

use App\Models\CmsPage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CmsPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CmsPage::truncate();
        $pages = [
            [
                'edited_by' => 1,
                'title' => 'Contact Us',
                'custom_id' => 'contact-us',
                'description' => 'Contact us detail',
                'file' => null,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'edited_by' => 1,
                'title' => 'About Us',
                'custom_id' => 'about-us',
                'description' => 'About Us',
                'file' => null,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'edited_by' => 1,
                'title' => 'Terms and Conditions',
                'custom_id' => 'terms-and-conditions',
                'description' => 'Terms and Conditions',
                'file' => null,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'edited_by' => 1,
                'title' => 'Privacy',
                'custom_id' => 'privacy',
                'description' => 'Privacy',
                'file' => null,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
        ];
        DB::table('cms_pages')->insert($pages);
    }
}
