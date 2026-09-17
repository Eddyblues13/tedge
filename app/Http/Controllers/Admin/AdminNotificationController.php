<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminNotification;
use Illuminate\Http\Request;

class AdminNotificationController extends Controller
{
    /**
     * Get recent notifications (JSON — called by the header polling).
     */
    public function index(Request $request)
    {
        $notifications = AdminNotification::latest()
            ->take(20)
            ->get()
            ->map(function ($n) {
                $config = AdminNotification::getTypeConfig($n->type);
                return [
                    'id'      => $n->id,
                    'type'    => $n->type,
                    'title'   => $n->title,
                    'message' => $n->message,
                    'icon'    => $config['icon'],
                    'bg'      => $config['bg'],
                    'color'   => $config['color'],
                    'is_read' => $n->is_read,
                    'time'    => $n->created_at->diffForHumans(),
                ];
            });

        $unreadCount = AdminNotification::unread()->count();

        return response()->json([
            'notifications' => $notifications,
            'unread_count'  => $unreadCount,
        ]);
    }

    /**
     * Mark a single notification as read.
     */
    public function markRead(AdminNotification $notification)
    {
        $notification->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllRead()
    {
        AdminNotification::unread()->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }
}
