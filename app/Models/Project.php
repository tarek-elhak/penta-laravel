<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class Project extends Model
{
    use HasFactory;
    protected $guarded = ["id"];
    public $timestamps = false;

    // project has many jobs

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    // demo example for inserting a new project
    public function insert(string $name, float $price, int $account_id)
    {
        //check to see if there are accounts with the provided id or not
        if(Account::find($account_id)){
            // go ahead and insert
            $project = $this->create(["name" => $name , "price" => $price , "account_id" => $account_id]);
            $project->save();
            dump("saved !");
        }else{
            dump("there is no account with the give id !");
        }
    }
    // demo example for selecting a project
    public function select(int $id)
    {
        try{
            dump ($this->findOrFail($id));
        }catch (ModelNotFoundException $e){
            dump($e->getMessage());
        }
    }
}
