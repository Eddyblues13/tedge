<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminNotification extends Model
{
    protected $fillable = [
        'type',
        'title',
        'message',
        'icon',
        'icon_bg',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    /**
     * Scope to get unread notifications.
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Get the badge color classes based on the notification type.
     */
    public static function getTypeConfig(string $type): array
    {
        return match ($type) {
            'Deposit'       => ['icon' => 'bi-box-arrow-in-down', 'bg' => 'rgba(16,185,129,0.12)', 'color' => '#10b981'],
            'Withdrawal'    => ['icon' => 'bi-box-arrow-up',      'bg' => 'rgba(239,68,68,0.12)',  'color' => '#ef4444'],
            'Plan Purchase' => ['icon' => 'bi-layers-fill',       'bg' => 'rgba(99,102,241,0.12)', 'color' => '#6366f1'],
            'Copy Trade'    => ['icon' => 'bi-arrow-left-right',  'bg' => 'rgba(245,158,11,0.12)', 'color' => '#f59e0b'],
            default         => ['icon' => 'bi-bell-fill',         'bg' => 'rgba(99,102,241,0.12)', 'color' => '#6366f1'],
        };
    }
}
