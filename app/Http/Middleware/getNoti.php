<?php

namespace App\Http\Middleware;

use App\Models\Comment;
use App\Models\Post;
use App\Models\PostLikes;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class getNoti
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session('userid')) {
            $noti_comments = Comment::with('post')->whereHas('post', function ($query) {
                $query->where('user_id', session('userid'));
            })->where('is_seen', 0)->get();
            $noti_likes = PostLikes::with('post')->whereHas('post', function ($query) {
                $query->where('user_id', session('userid'));
            })->where('is_seen', 0)->get();
            view()->share('noti_comment', $noti_comments);
            view()->share('noti_like', $noti_likes);
        }
        return $next($request);
    }
}
