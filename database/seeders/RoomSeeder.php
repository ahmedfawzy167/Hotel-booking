<?php

namespace Database\Seeders;
use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Room::create(["room_number"=> 123,"type" => "Single","price"=>150,"hotel_id"=>1]);
        Room::create(["room_number"=> 503,"type" => "Double","price"=>340,"hotel_id"=>2]);
        Room::create(["room_number"=> 220,"type" => "Single","price"=>200,"hotel_id"=>4]);
        Room::create(["room_number"=> 400,"type" => "Double","price"=>450,"hotel_id"=>5]);
        Room::create(["room_number"=> 207,"type" => "Double","price"=>500,"hotel_id"=>6]);
        Room::create(["room_number"=> 322,"type" => "Single","price"=>120,"hotel_id"=>9]);
        Room::create(["room_number"=> 400,"type" => "Double","price"=>360,"hotel_id"=>3]);
        Room::create(["room_number"=> 511,"type" => "Single","price"=>300,"hotel_id"=>8]);
        Room::create(["room_number"=> 199,"type" => "Single","price"=>720,"hotel_id"=>7]);
        Room::create(["room_number"=> 658,"type" => "Double","price"=>800,"hotel_id"=>10]);

    }
}
