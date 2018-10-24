<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class SearchesController extends Controller
{
    public function getIndex( Request $request ) {
        $s = $request->query('s');

        // Query and paginate result
        $posts = Post::where('title', 'like', "%$s%")
            ->orWhere('content', 'like', "%$s%")
            ->paginate(5);

        return view('pages.index', ['posts' => $posts, 's' => $s ]);
    }
}
