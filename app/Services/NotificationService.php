<?php

namespace App\Services;

use Firebase\FirebaseLib;
use App\Models\Notification;

class NotificationService
{
    public static $firebase;
    public static $defaultPath = '/';

    public function __construct()
    {
        self::$firebase = new FirebaseLib('https://swan-app-caa56.firebaseio.com/');
    }

    public function create($userId, $applicationId = null, $type, $notificationText, $redirectUrl, $userType){
        $notification = new Notification();
        $notification->application_id = $applicationId;
        $notification->type = $type;
        $notification->text = $notificationText;
        $notification->user_type = $userType;
        $notification->user_id = $userId;
        $notification->save();

        $nonSeenNotifications = $this->getUserNonSeenNotifications($userId);
        $notificationObject = [
            'id' => $notification->id,
            'application_id' => $applicationId,
            'text' => $notificationText,
            'user_type' => $userType,
            'type' => $type,
            'user_id' => $userId,
            'url' => $redirectUrl,
            'created_at' => $notification->created_at->format('d F, h:i'),
        ];
        //create notification on firebase
        self::$firebase->set(self::$defaultPath . '/users/'. $userId .'/counter/', $nonSeenNotifications);
        self::$firebase->set(self::$defaultPath . '/users/'. $userId .'/notifications/' . $notification->id, $notificationObject);
//        self::$firebase->set(self::$defaultPath . '/users/'. $userId .'/notifications/' . $notification->id . '/application_id', $applicationId);
//        self::$firebase->set(self::$defaultPath . '/users/'. $userId .'/notifications/' . $notification->id . '/text', $notificationText);
//        self::$firebase->set(self::$defaultPath . '/users/'. $userId .'/notifications/' . $notification->id . '/user_type', $userType);
//        self::$firebase->set(self::$defaultPath . '/users/'. $userId .'/notifications/' . $notification->id . '/type', $type);
//        self::$firebase->set(self::$defaultPath . '/users/'. $userId .'/notifications/' . $notification->id . '/user_id', $userId);
//        self::$firebase->set(self::$defaultPath . '/users/'. $userId .'/notifications/' . $notification->id . '/url', $redirectUrl);
//        self::$firebase->set(self::$defaultPath . '/users/'. $userId .'/notifications/' . $notification->id . '/created_at', $notification->created_at->format('d F, H:i'));

        return $notification;
    }

    public function getUserNonSeenNotifications($userId){
        return Notification::where(['seen' =>  0, 'user_id' => $userId])->count();
    }

    public function updateReadNotifications($userId){
        $notifications = Notification::where('user_id', $userId)->get();
        if(count($notifications) > 0)
            self::$firebase->set(self::$defaultPath . '/users/'. $userId .'/counter/', 0);

        return $notifications;
    }
}
