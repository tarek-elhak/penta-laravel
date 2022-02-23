<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Job;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /*
         * making two accounts with two projects per each
         */
        $accounts = Account::factory(2)->create();
        Project::factory(2)->create([
            "price" => 15000,
            "account_id" => $accounts[0]->id,
        ]);
        Project::factory(2)->create([
            "price" => 500,
            "account_id" => $accounts[1]->id,
        ]);
        /*
         * making two jobs per each project
         */
        $projects = Project::all();
        foreach($projects as $project):
            Job::factory(2)->create([
                "project_id" => $project->id
            ]);
        endforeach;

        /*
         * making two tasks per each job
         */
        $jobs = Job::all();
        foreach ($jobs as $job):
            Task::factory(2)->create([
                "job_id" => $job->id
            ]);
        endforeach;
    }
}
