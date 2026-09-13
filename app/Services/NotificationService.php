<?php

namespace App\Services;

use App\Models\NotificationModel;

class NotificationService
{
    public static function send(int $userId, string $type, string $title, string $body, ?string $actionUrl = null)
    {
        $notificationModel = new NotificationModel();
        
        $data = [
            'user_id'    => $userId,
            'type'       => $type,
            'title'      => $title,
            'body'       => $body,
            'action_url' => $actionUrl,
            'is_read'    => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        return $notificationModel->insert($data);
    }

    public static function markAsRead(int $notificationId, int $userId)
    {
        $notificationModel = new NotificationModel();
        
        // Ensure the notification belongs to the user
        $notification = $notificationModel->where('id', $notificationId)
                                          ->where('user_id', $userId)
                                          ->first();
                                          
        if ($notification) {
            return $notificationModel->update($notificationId, ['is_read' => 1]);
        }
        
        return false;
    }
}
