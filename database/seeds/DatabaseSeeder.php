<?php
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Eloquent::unguard();
    	DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    	$this->call(DistrictsTableSeeder::class);
    	$this->call(BarangayTableSeeder::class);
    	$this->call(AcademicGradingsTableSeeder::class);
    	$this->call(SchoolsTableSeeder::class);
    	$this->call(CoursesTableSeeder::class);
    	$this->call(BatchesTableSeeder::class);
    	$this->call(RequirementsTableSeeder::class);
    	$this->call(AllocationTypesTableSeeder::class);
    	$this->call(SettingsTableSeeder::class);
    	DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
