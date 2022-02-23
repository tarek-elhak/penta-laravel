<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Task extends Model
{
    use HasFactory;
    protected $guarded = ["id"];
    public $timestamps = false;

    //demo example for inserting a task
    public function insert(string $name , int $job_id)
    {
        // check if there is such job with that id or not
        if (Job::find($job_id)):
            // go ahead and insert
            $task = $this->create(["name" => $name , "job_id" => $job_id]);
            $task->save();
            dump("saved !");
        else:
            dump("there is no job with the give id !");
        endif;
    }
    //demo example for selecting a task
    public function select(int $id)
    {
        try{
            dump($this->findOrFail($id));
        }catch(ModelNotFoundException $e){
            dump($e->getMessage());
        }
    }

    // getting tasks belongs to project with price < 1000.
    public static function filter()
    {
        $projects = Project::where("price" , "<" , 1000)->get();
        foreach ($projects as $project):
            foreach ($project->jobs as $job):
                dump("tasks belongs to project: $project->name with price less than 1000");
                foreach ($job->tasks as $task):
                    dump($task->name);
                endforeach;
            endforeach;
        endforeach;
    }
}
