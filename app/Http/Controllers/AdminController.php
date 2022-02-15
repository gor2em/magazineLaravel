<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use function PHPUnit\Framework\fileExists;

class AdminController extends Controller
{
    public function index(Request $req)
    {
        return view("admin.admin", ['page_title' => 'Dashboard']);
    }
    public function posts(Request $req, $type = '', $id = '')
    {
        $post = new Post();
        switch ($type) {
            case 'add':
                if ($req->method() == "POST") {
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
                // var_dump($id);

                if ($req->method() == "POST") {
                    $validated = $req->validate([
                        'title' => 'required|string',
                        'file' => 'image',
                        'content' => 'required',
                    ]);

                    //image
                    if ($req->file('file')) {
                        $oldrow = $post->find($id);
                        if (file_exists('uploads/' . $oldrow->image)) {
                            unlink('uploads/' . $oldrow->image);
                        }
                        $path =  $req->file('file')->store('/', ['disk' => 'my_disk']);
                        $data['image'] = $path;
                    }

                    // $data['id'] = $id;
                    $data['title'] = $req->input('title');
                    $data['category_id'] = $req->input('category_id');
                    $data['content'] = $req->input('content');
                    $data['updated_at'] = date("Y-m-d H:i:s");

                    $post->where('id', $id)->update($data);
                    return redirect('admin/posts/edit/' . $id);
                }

                $row = $post->find($id);
                $category = $row->category()->first();

                // $data['page_title'] = "Edit Post";
                // $data['row'] = $row;
                // $data['category'] = $category;
                return view("admin.edit_post", [
                    'page_title' => 'Edit Post',
                    'row' => $row,
                    'category' => $category
                ]);
                break;

            case 'delete':

                $row = $post->find($id);
                $category = $row->category()->first();

                if ($req->method() == "POST") {
                    $row->delete();
                    return redirect('admin/posts');
                }

                // $data['page_title'] = "Edit Post";
                // $data['row'] = $row;
                // $data['category'] = $category;
                return view("admin.delete_post", [
                    'page_title' => 'Delete Post',
                    'row' => $row,
                    'category' => $category
                ]);
                break;

            default:
                //$post = new Post();
                //$rows = $post->all();

                //join query
                $query = "select posts.*, categories.category from posts join categories on posts.category_id = categories.id";
                $rows = DB::select($query);
                $data['page_title'] = "Posts";
                $data['rows'] = $rows;
                return view("admin.posts", $data);
                break;
        }
    }

    public function categories(Request $req, $type = '', $id = '')
    {
        $post = new Category();
        switch ($type) {
            case 'add':
                if ($req->method() == "POST") {
                    $validated = $req->validate([
                        'category' => 'required|string',
                    ]);

                    $data['category'] = $req->input('category');
                    $data['created_at'] = date("Y-m-d H:i:s");
                    $data['updated_at'] = date("Y-m-d H:i:s");

                    $post->insert($data);
                }
                return view("admin.add_category", ['page_title' => 'New Category']);
                break;

            case 'edit':
                // var_dump($id);

                if ($req->method() == "POST") {
                    $validated = $req->validate([
                        'category' => 'required|string',
                    ]);

                    $data['category'] = $req->input('category');
                    $data['updated_at'] = date("Y-m-d H:i:s");

                    $post->where('id', $id)->update($data);
                    return redirect('admin/categories/edit/' . $id);
                }

                $row = $post->find($id);

                return view("admin.edit_category", [
                    'page_title' => 'Edit Category',
                    'row' => $row,
                ]);
                break;

            case 'delete':

                $row = $post->find($id);

                if ($req->method() == "POST") {
                    $row->delete();
                    return redirect('admin/categories');
                }

                return view("admin.delete_category", [
                    'page_title' => 'Delete Category',
                    'row' => $row,
                ]);
                break;

            default:

                $query = "select * from categories order by id desc";
                $rows = DB::select($query);
                $data['page_title'] = "Categories";
                $data['rows'] = $rows;
                return view("admin.categories", $data);
                break;
        }
    }

    public function users(Request $req, $type = '', $id = '')
    {
        $post = new User();
        switch ($type) {

            case 'edit':
                if ($req->method() == "POST") {
                    $validated = $req->validate([
                        'name' => 'required|string',
                        'email' => 'required',
                        // 'password' => 'required',
                    ]);

                    $data['name'] = $req->input('name');
                    $data['email'] = $req->input('email');
                    if (!empty($req->input('password'))) {
                        $data['password'] = Hash::make($req->input('password'));
                    }
                    $data['updated_at'] = date("Y-m-d H:i:s");

                    $post->where('id', $id)->update($data);
                    return redirect('admin/users/edit/' . $id);
                }

                $row = $post->find($id);

                return view("admin.edit_user", [
                    'page_title' => 'Edit User',
                    'row' => $row,
                ]);
                break;

            case 'delete':

                $row = $post->find($id);

                if ($req->method() == "POST") {

                    if ($row->id != 1) {
                        $row->delete();
                    }
                    return redirect('admin/users');
                }

                return view("admin.delete_user", [
                    'page_title' => 'Delete User',
                    'row' => $row,
                ]);
                break;

            default:

                $query = "select * from users order by id desc";
                $rows = DB::select($query);
                $data['page_title'] = "Users";
                $data['rows'] = $rows;
                return view("admin.users", $data);
                break;
        }
    }

    public function save(Request $req)
    {
    }
}
