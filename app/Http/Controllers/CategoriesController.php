<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Topic;
use App\Models\Link;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function show(Category $category, Link $link, Request $request, Topic $topic, User $user)
    {
        $topics = $topic->withOrder($request->order)
                        ->where('category_id', $category->id)
                        ->paginate(20);
        $active_users = $user->getActiveUsers();
        $links = $link->getAllCached();
        return view('topics.index', compact('topics', 'category', 'active_users', 'links'));
    }
}
