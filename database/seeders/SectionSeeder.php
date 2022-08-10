<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Section::truncate();
        Schema::enableForeignKeyConstraints();
        $sections = [
                [
                    'name'          =>  'Dashboard',
                    'icon'          =>  'icon-home',
                    'image'         =>  '',
                    'icon_type'     =>  'line-icons',
                    'sequence'      =>  1,
                    'is_active'     => 'y',
                    'created_at'    => \Carbon\Carbon::now(),
                    'updated_at'    => \Carbon\Carbon::now(),
                ],
                [
                    'name'          =>  'Role Management',
                    'icon'          =>  'fab fa-black-tie',
                    'image'         =>  '',
                    'icon_type'     =>  'font-awesome',
                    'sequence'      =>  2,
                    'is_active'     => 'y',
                    'created_at'    => \Carbon\Carbon::now(),
                    'updated_at'    => \Carbon\Carbon::now(),
                ],
                [
                    'name'          =>  'Client Management',
                    'icon'          =>  'icon-users ',
                    'image'         =>  '',
                    'icon_type'     =>  'line-icons',
                    'sequence'      =>  3,
                    'is_active'     => 'y',
                    'created_at'    => \Carbon\Carbon::now(),
                    'updated_at'    => \Carbon\Carbon::now(),
                ],
                [
                    'name'          =>  'Gallery',
                    'icon'          =>  'fa fa-check    ',
                    'image'         =>  '',
                    'icon_type'     =>  'font-awesome',
                    'sequence'      =>  4,
                    'is_active'     => 'y',
                    'created_at'    => \Carbon\Carbon::now(),
                    'updated_at'    => \Carbon\Carbon::now(),
                ],
                [
                    'name'          =>  'FAQ Management',
                    'icon'          =>  'fa fa-question-circle',
                    'image'         =>  '',
                    'icon_type'     =>  'font-awesome',
                    'sequence'      =>  5,
                    'is_active'     => 'y',
                    'created_at'    => \Carbon\Carbon::now(),
                    'updated_at'    => \Carbon\Carbon::now(),
                ],
                [
                    'name'          =>  'CMS Management',
                    'icon'          =>  'fa fa-cogs',
                    'image'         =>  '',
                    'icon_type'     =>  'font-awesome',
                    'sequence'      =>  6,
                    'is_active'     => 'y',
                    'created_at'    => \Carbon\Carbon::now(),
                    'updated_at'    => \Carbon\Carbon::now(),
                ],
                [
                    'name'          =>  'Country',
                    'icon'          =>  'fas fa-cogs',
                    'image'         =>  '',
                    'icon_type'     =>  'font-awesome',
                    'sequence'      =>  7,
                    'is_active'     => 'y',
                    'created_at'    => \Carbon\Carbon::now(),
                    'updated_at'    => \Carbon\Carbon::now(),
                ],
                [
                    'name'          =>  'State',
                    'icon'          =>  'fas fa-cogs',
                    'image'         =>  '',
                    'icon_type'     =>  'font-awesome',
                    'sequence'      =>  8,
                    'is_active'     => 'y',
                    'created_at'    => \Carbon\Carbon::now(),
                    'updated_at'    => \Carbon\Carbon::now(),
                ],
                [
                    'name'          =>  'Cities',
                    'icon'          =>  'fas fa-cogs',
                    'image'         =>  '',
                    'icon_type'     =>  'font-awesome',
                    'sequence'      =>  9,
                    'is_active'     => 'y',
                    'created_at'    => \Carbon\Carbon::now(),
                    'updated_at'    => \Carbon\Carbon::now(),
                ],
                [
                    'name'          =>  'Addresses',
                    'icon'          =>  'fas fa-cogs',
                    'image'         =>  '',
                    'icon_type'     =>  'font-awesome',
                    'sequence'      =>  10,
                    'is_active'     => 'y',
                    'created_at'    => \Carbon\Carbon::now(),
                    'updated_at'    => \Carbon\Carbon::now(),
                ],
                [
                    'name'          =>  'Category',
                    'icon'          =>  'fas fa-cogs',
                    'image'         =>  '',
                    'icon_type'     =>  'font-awesome',
                    'sequence'      =>  11,
                    'is_active'     => 'y',
                    'created_at'    => \Carbon\Carbon::now(),
                    'updated_at'    => \Carbon\Carbon::now(),
                ],
                [
                    'name'          =>  'Event',
                    'icon'          =>  'fas fa-cogs',
                    'image'         =>  '',
                    'icon_type'     =>  'font-awesome',
                    'sequence'      =>  12,
                    'is_active'     => 'y',
                    'created_at'    => \Carbon\Carbon::now(),
                    'updated_at'    => \Carbon\Carbon::now(),
                ],
                [
                    'name'          =>  'Donation',
                    'icon'          =>  'fas fa-cogs',
                    'image'         =>  '',
                    'icon_type'     =>  'font-awesome',
                    'sequence'      =>  13,
                    'is_active'     => 'y',
                    'created_at'    => \Carbon\Carbon::now(),
                    'updated_at'    => \Carbon\Carbon::now(),
                ],
                [
                    'name'          =>  'Team',
                    'icon'          =>  'fas fa-cogs',
                    'image'         =>  '',
                    'icon_type'     =>  'font-awesome',
                    'sequence'      =>  14,
                    'is_active'     => 'y',
                    'created_at'    => \Carbon\Carbon::now(),
                    'updated_at'    => \Carbon\Carbon::now(),
                ],
        ];
        Section::insert($sections);
        
    }
}
