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

class NotificationTypeController extends Controller
{

    public function index() {
        return view('notificationType.index');
    }
    
    public function getAll(){
        $notificationTypes = NotificationType::all();
        return response()->json([
            'status' => '200',
            'notificationTypes' => $notificationTypes
        ]);
    }

    public function get($id){
        $notificationType = NotificationType::find($id);
        return response()->json([
            'status' => '200',
            'notificationType' => $notificationType
        ]
        );
    }

    public function delete(Request $request)
    {
        $notificationType = NotificationType::find($request->id);

        if (!$notificationType) {
            return response()->json([
                'status' => '400',
                'message' => __('language.error_no_item_selected')
            ], 400);
        }

        try {
            $notificationType->delete();
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
            NotificationType::whereIn('id', $request->ids)->delete();

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
