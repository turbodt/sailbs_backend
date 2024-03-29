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
        $this->call('RolesTableSeeder');
        // $this->call('UsersTableSeeder');
        $this->call('TokensTableSeeder');
        $this->call('LanguagesTableSeeder');
        $this->call('CertificatesTableSeeder');
        $this->call('SubjectsTableSeeder');
        $this->call('QuestionsTableSeeder');
        $this->call('AnswersTableSeeder');
        $this->call('ExamsTableSeeder');
    }
}
