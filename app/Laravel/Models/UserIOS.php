<?php

namespace App\Laravel\Models;

use App\Laravel\Models\User;

class UserIOS extends User
{
	/**
     * Route notifications for the FCM channel.
     *
     * @return string
     */
    public function routeNotificationForFcm()
    {
        return $this->devices()
        			->where('device_name', 'ios')
        			->where('is_login', '1')
        			->pluck('reg_id')
        			->toArray() ?: 'ios123';
    }
}