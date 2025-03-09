<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Notification;
use App\Models\NotificationType;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DashboardController extends Controller
{
    //trang chủ cho quản trị (thống kê cơ bản)
    public function index() {
        return view('dashboard.index');
    }
    
    //API lấy tổng người dùng
    public function getTotalUsers(){
        $total = User::where('role', '!=', User::$role_admin) -> count();
        $countLastMonth = User::where('role', '!=', User::$role_admin)->whereMonth('created_at', Carbon::now()->subMonth()->month)
                        ->whereYear('created_at', Carbon::now()->subMonth()->year)
                        ->count();

        $countThisMonth = User::where('role', '!=', User::$role_admin)->whereMonth('created_at', date('m'))
                            ->whereYear('created_at', date('Y'))
                            ->count();


        if ($countLastMonth == 0) {
            $percent_increase = $countThisMonth > 0 ? 100 : 0;
        } else {
            $percent_increase = ($countThisMonth - $countLastMonth) * 100 / $countLastMonth;
        }

        return response()->json([
            'status' => '200',
            'total' => $total,
            'percent_increase' => $percent_increase,
        ]);
    }

    //API lấy tổng bài đăng
    public function getTotalPosts(){
        $total = Post::count();
        $countLastMonth = Post::whereMonth('created_at', Carbon::now()->subMonth()->month)
                        ->whereYear('created_at', Carbon::now()->subMonth()->year)
                        ->count();

        $countThisMonth = Post::whereMonth('created_at', date('m'))
                            ->whereYear('created_at', date('Y'))
                            ->count();


        if ($countLastMonth == 0) {
            $percent_increase = $countThisMonth > 0 ? 100 : 0;
        } else {
            $percent_increase = ($countThisMonth - $countLastMonth) * 100 / $countLastMonth;
        }

        return response()->json([
            'status' => '200',
            'total' => $total,
            'percent_increase' => $percent_increase,
        ]);
    }

    //API lấy tổng lượt xem bài đăng
    public function getTotalViews(){
        $total = Post::sum('view_count');

        return response()->json([
            'status' => '200',
            'total' => $total,
        ]);
    }

    //API lấy tổng số lượng bình luận
    public function getTotalComments(){
        $total = Comment::count();
        $countLastMonth = Comment::whereMonth('created_at', Carbon::now()->subMonth()->month)
                        ->whereYear('created_at', Carbon::now()->subMonth()->year)
                        ->count();

        $countThisMonth = Comment::whereMonth('created_at', date('m'))
                            ->whereYear('created_at', date('Y'))
                            ->count();


        if ($countLastMonth == 0) {
            $percent_increase = $countThisMonth > 0 ? 100 : 0;
        } else {
            $percent_increase = ($countThisMonth - $countLastMonth) * 100 / $countLastMonth;
        }

        return response()->json([
            'status' => '200',
            'total' => $total,
            'percent_increase' => $percent_increase,
        ]);
    }

    
    //API lấy dữ liệu thống kê bài đăng theo tuần và tháng
    public function getPublishedPostsStatistics(){
        
        $weekly_posts = [];
        $startOfWeek = Carbon::now()->startOfWeek();

        for ($day = 0; $day < 7; $day++) {
            $date = $startOfWeek->copy()->addDays($day);
            $postsCount = Post::whereDate('created_at', $date)->count();

            $weekly_posts[$day] = $postsCount;
        }

        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        $weeks_data = [];
        $currentWeekStart = $startOfMonth->copy();
        $index = 0;
        while ($currentWeekStart->lte($endOfMonth)) {
            $currentWeekEnd = $currentWeekStart->copy()->endOfWeek();

            if ($currentWeekEnd->gt($endOfMonth)) {
                $currentWeekEnd = $endOfMonth;
            }

            $postsCount = Post::whereBetween('created_at', [$currentWeekStart, $currentWeekEnd])->count();

            $weeks_data[$index++] = $postsCount;

            $currentWeekStart = $currentWeekEnd->copy()->addDay();
        }

        return response()->json([
            'status' => '200',
            'weekly_posts' => $weekly_posts,
            'weeks_count' => $index,
            'weeks_data' => $weeks_data,
        ]);
    }

    //API lấy danh sách bài post mới nhất với limit 4 bài
    public function getLastestPost() {
        $limit = 4;
        $lastest_posts = Post::with('user', 'category') -> latest()->take($limit)->get();
        $count = Post::count();
        return response()->json([
            'status' => '200',
            'lastest_posts' => $lastest_posts->map(function ($post) {
                return [
                    'id' => $post->id,
                    'link' => $post->link,
                    'user' => $post->user,
                    'category' => $post->category,
                    'title' => $post->title,
                    'description' => $post->description,
                    'like_count' => $post->like_count,
                    'view_count' => $post->view_count,
                    'comment_count' => $post->comments()->count(),
                    'created_at' => $post->created_at->diffForHumans(),
                ];
            }),
            'has_more' => $lastest_posts->count() < $count,
        ]);
    }

    //API lấy thêm các bài đăng tiếp theo với limit 4
    public function getLoadMorePost (Request $request)
    {
        $limit = 4;
        $offset = $request->input('offset', 0);
        $lastest_posts = Post::with('user', 'category')
            ->latest()
            ->skip($offset)
            ->take($limit)
            ->get();
        
        $count = Post::count();
        return response()->json([
            'status' => '200',
            'lastest_posts' => $lastest_posts->map(function ($post) {
                return [
                    'id' => $post->id,
                    'link' => $post->link,
                    'user' => $post->user,
                    'category' => $post->category,
                    'title' => $post->title,
                    'description' => $post->description,
                    'like_count' => $post->like_count,
                    'view_count' => $post->view_count,
                    'comment_count' => $post->comments()->count(),
                    'created_at' => $post->created_at->diffForHumans(),
                ];
            }),
            'has_more' => $offset + $lastest_posts->count() < $count
        ]);
    }
}
