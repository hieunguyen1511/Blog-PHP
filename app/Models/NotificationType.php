<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationType extends Model
{
    //
    protected $table = 'notificationtype';
    use HasFactory;
    
    public static function getArrayNotificationTypes() {
        return ['published_a_new_post', 'commented_on', 'updated_their_profile_information'];
    }
}
