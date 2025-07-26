<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\BlogCommentDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogComment;


class BlogCommentController extends Controller
{
    public function index(BlogCommentDataTable $dataTable)
    {
        return $dataTable->render('admin.blog.blog-comment.index');
    }

    public function destory(string $id)
    {
        $comment = BlogComment::findOrFail($id);
        $comment->delete();

        return response(['status' => 'success', 'message' => 'message']);
    }
}