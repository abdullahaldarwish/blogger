<?php

namespace Database\Seeders;

use App\Models\category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $author1 = User::create([
            'name'=>'nada',
            'email'=>'na@da.com',
            'password'=>Hash::make('password')
        ]);
        $author2 = User::create([
            'name'=>'dana',
            'email'=>'da@na.com',
            'password'=>Hash::make('password')
        ]);
        $author3 = User::create([
            'name'=>'dada',
            'email'=>'da@da.com',
            'password'=>Hash::make('password')
        ]);
        $category1 = category::create([
            'name'=>'news'
        ]);
        $category2 = category::create([
            'name'=>'marketing'
        ]);
        $category3 = category::create([
            'name'=>'partnership'
        ]);
        $post1 =post::create([
            'title'=>'We relocated our office to a new designed garage',
            'description'=>'desc1',
            'content'=>'content1',
            'category_id'=>$category1->id,
            'image'=>'posts/1.jpg',
            'user_id'=>$author1->id
        ]);
        $post2 =$author3->posts()->create([
            'title'=>'Top 5 brilliant content marketing strategies',
            'description'=>'desc2',
            'content'=>'content2',
            'category_id'=>$category2->id,
            'image'=>'posts/2.jpg'
        ]);
        $post3 =$author3->posts()->create([
            'title'=>'Best practices for minimalist design with example',
            'description'=>'desc3',
            'content'=>'content3',
            'category_id'=>$category3->id,
            'image'=>'posts/3.jpg'
        ]);

        

        $tag1 = Tag::create([
            'name'=>'job'
        ]);
        $tag2 = Tag::create([
            'name'=>'customers'
        ]);
        $tag3 = Tag::create([
            'name'=>'record'
        ]);
        $post1->tags()->attach([$tag1->id,$tag2->id]);
        $post2->tags()->attach([$tag2->id,$tag3->id]);
        $post3->tags()->attach([$tag1->id,$tag3->id]);
        
    }
}
