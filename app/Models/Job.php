<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Job extends Model
{
    use HasFactory;
    protected $guarded = ["id"];
    public $timestamps = false;


    // Job has many tasks

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    // demo example for inserting a new job
    public function insert(string $name , float $amount , int $project_id)
    {
        //check if there is such a project with the given id
        if (Project::find($project_id)){
            //go ahead and insert
            $job = $this->create(["name" => $name , "amount" => $amount , "project_id" => $project_id]);
            $job->save();
            dump("saved !");

        }else{
            dump("there is no project with the give id !");
        }
    }
    //demo example for selecting a job
    public function select(int $id)
    {
        try{
            dump($this->findOrFail($id));
        }catch (ModelNotFoundException $e){
            dump($e->getMessage());
        }
    }
}
