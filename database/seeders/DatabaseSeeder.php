<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Barber\Shop\Models\Shop;
use Modules\Barber\ShopHour\Models\ShopHour;
use Modules\Barber\ShopHour\Models\ShopHourDetail;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $shop = Shop::first(); // Get the first shop (change logic as needed)
        if (!$shop) {
            return;
        }

        // Define custom times for specific days
        $customHours = [
            'Monday'    => ['07:00 AM', '12:00 PM'],
            'Saturday'  => ['02:00 PM', '05:00 PM'],
        ];

        // Default opening and closing times for other days
        $defaultOpeningTime = '10:00 AM';
        $defaultClosingTime = '07:00 PM';

        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        foreach ($days as $day) {
            $openingTime = $customHours[$day][0] ?? $defaultOpeningTime;
            $closingTime = $customHours[$day][1] ?? $defaultClosingTime;

            // Convert to 24-hour format for MySQL
            $openingTime = date("H:i:s", strtotime($openingTime));
            $closingTime = date("H:i:s", strtotime($closingTime));

            // Create ShopHour entry
            $shopHour = ShopHour::create([
                'shop_id' => $shop->id,
                'day' => $day,
                'opening_time' => $openingTime,
                'closing_time' => $closingTime,
            ]);

            // Generate 30-minute intervals
            $startTime = strtotime($openingTime);
            $endTime = strtotime($closingTime);

            while ($startTime < $endTime) {
                $slotStart = date("H:i:s", $startTime);
                $slotEnd = date("H:i:s", strtotime("+30 minutes", $startTime));

                if (strtotime($slotEnd) > $endTime) {
                    break;
                }

                ShopHourDetail::create([
                    'shop_hour_id' => $shopHour->id,
                    'start_time' => $slotStart,
                    'end_time' => $slotEnd,
                ]);

                $startTime = strtotime("+30 minutes", $startTime);
            }
        }
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
