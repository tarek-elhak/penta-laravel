<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Account extends Model
{
    use HasFactory;
    protected $guarded = ["id"];
    public $timestamps = false;

    // Account has many projects
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
    // demo example for inserting a new Account
    public function insert(string $accountName)
    {
        //check fo the uniqueness of the account name first !
        if (count($this->where("name",$accountName)->get()) != 0){
            dump ("the name is already exists !");
        }else{
            $this->name = $accountName;
            $this->save();
            dump("saved !");
        }
    }
    // demo example for selecting an Account
    public function select(int $id)
    {
        try{
            dump ($this->findOrFail($id));
        }catch(ModelNotFoundException $e){
            dump ($e->getMessage());
        }
    }

}
