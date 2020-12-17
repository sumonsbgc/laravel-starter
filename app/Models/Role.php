<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'nickname'
    ];

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function getRoles(){
        return $this->query()->get();
    }

    public function store(Request $req){
        $data = [];

        $data['name'] = Str::ucfirst($req->name);
        $data['nickname'] = Str::slug($req->name);
        
        return $this->newQuery()->create($data);
    }
    
    public function findById(int $id){
        return $this->query()->find($id);
    }

}