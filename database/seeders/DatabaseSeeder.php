<?php

namespace Database\Seeders;

use App\Models\Hotel;
use App\Models\HotelAttribute;
use App\Models\HotelRoom;
use App\Models\RoomAttribute;
use Database\Factories\RoomFactory;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder.
 */
class DatabaseSeeder extends Seeder
{
    use TruncateTable;

    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Model::unguard();

        // $this->truncateMultiple([
        //     'activity_log',
        //     'failed_jobs',
        // ]);

        // $this->call(AuthSeeder::class);
        // $this->call(AnnouncementSeeder::class);

        Hotel::factory()->count(50)->create();
        HotelAttribute::factory()->count(150)->create();
        HotelRoom::factory()->count(100)->create();
        RoomAttribute::factory()->count(300)->create();
        Model::reguard();
    }
}
