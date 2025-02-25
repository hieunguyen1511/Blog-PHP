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
    public function index() {
        return view('dashboard.index');
    }
    
    public function getTotalUsers(){
        $total = User::count();
        $countLastMonth = User::whereMonth('created_at', Carbon::now()->subMonth()->month)
                        ->whereYear('created_at', Carbon::now()->subMonth()->year)
                        ->count();

        $countThisMonth = User::whereMonth('created_at', date('m'))
                            ->whereYear('created_at', date('Y'))
                            ->count();


        if ($countLastMonth == 0) {
            $percent_increase = $countThisMonth > 0 ? 100 : 0; // Nếu có user, tăng trưởng 100%, nếu không thì 0%
        } else {
            $percent_increase = ($countThisMonth - $countLastMonth) * 100 / $countLastMonth;
        }

        return response()->json([
            'status' => '200',
            'total' => $total,
            'percent_increase' => $percent_increase,
        ]);
    }

    public function getTotalPosts(){
        $total = Post::count();
        $countLastMonth = Post::whereMonth('created_at', Carbon::now()->subMonth()->month)
                        ->whereYear('created_at', Carbon::now()->subMonth()->year)
                        ->count();

        $countThisMonth = Post::whereMonth('created_at', date('m'))
                            ->whereYear('created_at', date('Y'))
                            ->count();


        if ($countLastMonth == 0) {
            $percent_increase = $countThisMonth > 0 ? 100 : 0; // Nếu có user, tăng trưởng 100%, nếu không thì 0%
        } else {
            $percent_increase = ($countThisMonth - $countLastMonth) * 100 / $countLastMonth;
        }

        return response()->json([
            'status' => '200',
            'total' => $total,
            'percent_increase' => $percent_increase,
        ]);
    }

    public function getTotalViews(){
        $total = Post::sum('view_count');

        return response()->json([
            'status' => '200',
            'total' => $total,
        ]);
    }

    public function getTotalComments(){
        $total = Comment::count();
        $countLastMonth = Comment::whereMonth('created_at', Carbon::now()->subMonth()->month)
                        ->whereYear('created_at', Carbon::now()->subMonth()->year)
                        ->count();

        $countThisMonth = Comment::whereMonth('created_at', date('m'))
                            ->whereYear('created_at', date('Y'))
                            ->count();


        if ($countLastMonth == 0) {
            $percent_increase = $countThisMonth > 0 ? 100 : 0; // Nếu có user, tăng trưởng 100%, nếu không thì 0%
        } else {
            $percent_increase = ($countThisMonth - $countLastMonth) * 100 / $countLastMonth;
        }

        return response()->json([
            'status' => '200',
            'total' => $total,
            'percent_increase' => $percent_increase,
        ]);
    }

    
    public function getPublishedPostsStatistics(){
        

        // Lấy danh sách bài viết theo từng ngày trong tuần
        $weekly_posts = [];

        $startOfWeek = Carbon::now()->startOfWeek(); // Lấy Thứ 2

        for ($day = 0; $day < 7; $day++) {
            $date = $startOfWeek->copy()->addDays($day);
            $postsCount = Post::whereDate('created_at', $date)->count();

            $weekly_posts[$day] = $postsCount;
        }

        $startOfMonth = Carbon::now()->startOfMonth(); // Ngày đầu tháng
        $endOfMonth = Carbon::now()->endOfMonth(); // Ngày cuối tháng
        $weeks_data = [];
        $currentWeekStart = $startOfMonth->copy();
        $index = 0;
        while ($currentWeekStart->lte($endOfMonth)) {
            $currentWeekEnd = $currentWeekStart->copy()->endOfWeek(); // Cuối tuần hiện tại

            // Giới hạn trong tháng
            if ($currentWeekEnd->gt($endOfMonth)) {
                $currentWeekEnd = $endOfMonth;
            }

            // Đếm số bài post trong tuần
            $postsCount = Post::whereBetween('created_at', [$currentWeekStart, $currentWeekEnd])->count();

            // Lưu dữ liệu
            $weeks_data[$index++] = $postsCount;

            // Chuyển sang tuần tiếp theo
            $currentWeekStart = $currentWeekEnd->copy()->addDay();
        }

        return response()->json([
            'status' => '200',
            'weekly_posts' => $weekly_posts,
            'weeks_count' => $index,
            'weeks_data' => $weeks_data,
        ]);
    }

    public function getRecentActivity() {
        $last_notification = Notification::with('user', 'notificationType') -> latest()->take(4)->get();
        return response()->json([
            'status' => '200',
            'array_notification_types' => NotificationType::getArrayNotificationTypes(),
            'last_notification' => $last_notification->map(function ($noti) {
                return [
                    'id' => $noti->id,
                    'content' => $noti->content,
                    'description' => $noti->description,
                    'user' => $noti->user,
                    'created_at' => $noti->created_at->diffForHumans(),
                    'noti_type_name' => $noti->notificationType ? $noti -> notificationType->name : 'Unknow',
                    'noti_type_code' => $noti->notificationType->code,
                ];
            })
        ]);
    }
}
