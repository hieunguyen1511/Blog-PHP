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

class NotificationController extends Controller
{
    public function index() {
        return view('notification.index');
    }

    public function getData() {
        try {
            $users = User::get();
            $notificationTypes = NotificationType::get();
    
            return response()->json([
                'status' => '200',
                'users' => $users,
                'notificationTypes' => $notificationTypes,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => '500',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    
    
    public function getAll(){
        $notifications = Notification::with('user')->with('notificationType')->get();
        return response()->json([
            'status' => '200',
            'notifications' => $notifications->map(function ($noti) {
                return [
                    'id' => $noti->id,
                    'user' => [
                        'id' => $noti->user->id ?? null,
                        'full_name' => $noti->user->full_name ?? __('language.error_unknow'),
                        'profile_picture' => $noti->user->profile_picture ?? asset('default_avatar.jpg'),
                    ],
                    'content' => $noti->content,
                    'noti_type_name' => $noti->notificationType->name ?? __('language.error_unknow'),
                    'created_at' => $noti->created_at->diffForHumans(),
                ];
            })
        ]);
    }

    public function get($id){
        $notification = Notification::find($id);
        return response()->json([
            'status' => '200',
            'notification' => [
                    'id' => $notification->id,
                    'user_id' => $notification->user_id,
                    'content' => $notification->content,
                    'noti_type' => $notification->notificationType->id,
            ],
        ]
        );
    }

    public function update(Request $request) {
        $notification = Notification::find($request->id);  // Lấy category theo ID
    
        if (!$notification) {
            return response()->json([
                'status' => '400',
                'message' => __('language.error_no_item_selected')
            ], 400);
        }
    
        $notification->user_id = $request->user_id; 
        $notification->content = $request->content; 
        $notification->noti_type = $request->noti_type; 
    
        
        try {
            $notification->save();  // Lưu thay đổi
            return response()->json([
                'status' => '200',
                'message' => __('language.updated_item_success')  // Thành công
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => '500',
                'message' => __('language.update_item_fail')
            ], 500);
        }
    }

    public function delete(Request $request)
    {
        $notification = Notification::find($request->id);

        if (!$notification) {
            return response()->json([
                'status' => '400',
                'message' => __('language.error_no_item_selected')
            ], 400);
        }

        try {
            $notification->delete();
            return response()->json([
                'status' => '200',
                'message' => __('language.deleted_item_success')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => '500',
                'message' => __('language.delete_item_fail')
            ], 500);
        }
    }


    public function deleteItems(Request $request)
    {
        if (!isset($request->ids) || count($request->ids) === 0) {
            return response()->json([
                'status' => '400',
                'message' => __('language.error_no_item_selected')
            ], 400);
        }

        try {
            Notification::whereIn('id', $request->ids)->delete();

            return response()->json([
                'status' => '200',
                'message' => __('language.deleted_items_success')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => '500',
                'message' => __('language.delete_items_fail')
            ], 500);
        }
    }
}
