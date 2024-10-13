<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Dashboards 1 - 2
        Section::updateOrCreate(['id' => 1], ['name' => 'admin_general_dashboard', 'caption' => 'General_Dashboard']);
        Section::updateOrCreate(['id' => 2], ['name' => 'admin_general_dashboard_show', 'section_group_id' => 1, 'caption' => "General_Dashboard_page"]);

        // Roles 3 - 7
        Section::updateOrCreate(['id' => 3], ['name' => 'Admin_Roles', 'caption' => 'Admin_Roles']);
        Section::updateOrCreate(['id' => 4], ['name' => 'Show_Admin_Roles', 'section_group_id' => 3, 'caption' => 'Show_Admin_Roles']);
        Section::updateOrCreate(['id' => 5], ['name' => 'Create_Admin_Roles', 'section_group_id' => 3, 'caption' => 'Create_Admin_Roles']);
        Section::updateOrCreate(['id' => 6], ['name' => 'Edit_Admin_Roles', 'section_group_id' => 3, 'caption' => 'Edit_Admin_Roles']);
        Section::updateOrCreate(['id' => 7], ['name' => 'Update_Admin_Roles', 'section_group_id' => 3, 'caption' => 'Update_Admin_Roles']);
        Section::updateOrCreate(['id' => 8], ['name' => 'Delete_Admin_Roles', 'section_group_id' => 3, 'caption' => 'Delete_Admin_Roles']);

    }
}
