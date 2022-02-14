<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

class AdminController extends Controller
{
    public function index(Request $req)
    {
        return view("admin.admin", ['page_title' => 'Dashboard']);
    }
    public function posts(Request $req, $type = '')
    {
        switch ($type) {
            case 'add':
                if ($req->method() == "POST") {
                    $post = new Post();
                    $validated = $req->validate([
                        'title' => 'required|string',
                        'file' => 'required|image',
                        'content' => 'required',
                    ]);
                    $path =  $req->file('file')->store('/', ['disk' => 'my_disk']);

                    $data['title'] = $req->input('title');
                    $data['category_id'] = 1; //fake
                    $data['image'] = $path;
                    $data['created_at'] = date("Y-m-d H:i:s");
                    $data['updated_at'] = date("Y-m-d H:i:s");
                    $data['content'] = $req->input('content');

                    $post->insert($data);
                }
                return view("admin.add_posts", ['page_title' => 'New Post']);
                break;

            case 'edit':
                return view("admin.posts", ['page_title' => 'Edit Post']);
                break;

            case 'delete':
                return view("admin.posts", ['page_title' => 'Delete Post']);
                break;

            default:
                $post = new Post();
                $rows = $post->all();
                $data['page_title'] = "Posts";
                $data['rows'] = $rows;
                return view("admin.posts", $data);
                break;
        }
    }

    public function categories(Request $req)
    {
        return view("admin.admin", ['page_title' => 'Categories']);
    }
    public function users(Request $req)
    {
        return view("admin.admin", ['page_title' => 'Users']);
    }

    public function save(Request $req)
    {
    }
}
