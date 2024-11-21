<?php

use Illuminate\Database\Seeder;
use App\Models\Notification;

class NotificationsSeeder extends Seeder
{
    public function run()
    {
        Notification::factory(15)->create(); // Generates 15 notifications
    }
}
