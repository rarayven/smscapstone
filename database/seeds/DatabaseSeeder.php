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
        $this->call(UsersTableSeeder::class);
        $this->call(FamilyDataTableSeeder::class);
        $this->call(EducationalBackgroundsTableSeeder::class);
        $this->call(SiblingsTableSeeder::class);
        $this->call(SemestersTableSeeder::class);
        $this->call(BatchesTableSeeder::class);
        $this->call(StudentDetailsTableSeeder::class);
        $this->call(GradesTableSeeder::class);
        $this->call(YearsTableSeeder::class);
        $this->call(BarangayTableSeeder::class);
        $this->call(SchoolsTableSeeder::class);
        $this->call(DesiredCoursesTableSeeder::class);
        $this->call(DistrictsTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
        $this->call(CouncilorsTableSeeder::class);
        $this->call(CurrentCollegesTableSeeder::class);
        $this->call(ShiftsTableSeeder::class);
        $this->call(UserCouncilorTableSeeder::class);
        $this->call(AcademicGradingsTableSeeder::class);
        $this->call(AllocationsTableSeeder::class);
        $this->call(SchoolFeesTableSeeder::class);
        $this->call(AllocationTypesTableSeeder::class);
        $this->call(UserMessageTableSeeder::class);
        $this->call(MessagesTableSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(UserEventTableSeeder::class);
        $this->call(UserAnnouncementTableSeeder::class);
        $this->call(AnnouncementsTableSeeder::class);
        $this->call(AchievementsTableSeeder::class);
        $this->call(StepsTableSeeder::class);
        $this->call(PasswordResetsTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(MigrationsTableSeeder::class);
        $this->call(UserStepTableSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
