<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softdeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use softdeletes;

    

    protected $fillable = [
        'title', 'description', 'content', 'image', 'published_at', 'category_id','user_id'
    ];
    /**
     * @return void
     */

    public function deleteImage(){
        Storage::delete($this->image);
    }

    public function category(){
        return $this->belongsTo(category::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function scopeSearched($query){
        $search = request()->query('search');

        if(!$search){
            return $query;
        }

        return $query->where('title','LIKE',"%{$search}%");
    }
    public function HasTag(){
        return $this->belongsToMany(Tag::class);
    }
}
