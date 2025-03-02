<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Notification;
use App\Models\NotificationType;
use App\Models\Post;
use App\Models\SeenNotification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SeenNotificationController extends Controller
{

    public function create(Request $request)
    {
        $seenNotification = SeenNotification::where('user_id', $request->user_id)
                            ->where('noti_id', $request->noti_id)
                            ->first();
        if (!$seenNotification) {
            $seen_notification = new SeenNotification();
            $seen_notification->user_id = $request->user_id;
            $seen_notification->noti_id = $request->noti_id;
            try {
                $seen_notification->save();
                return response()->json([
                    'status' => '200',
                    'message' => __('language.created_item_success')
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => '500',
                    'message' => __('language.create_item_fail')
                ], 500);
            }
        }
        return response()->json([
            'status' => '200',
            'message' => __('language.created_item_success')
        ]);
        
    }
}
