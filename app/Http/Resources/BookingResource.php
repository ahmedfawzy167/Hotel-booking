<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $bookings = $this->resource->items();

        return [
           'status' => 200,
           'data' => array_map(function ($booking) {
               return [
                   'id' => $booking->id,
                   'check_in_date' => $booking->check_in_date,
                   'check_out_date' => $booking->check_out_date,
                   'user_id' => $booking->user->name,
                   'hotel_id' => $booking->hotel->name,
                   'created_at' => $booking->created_at,
                   'updated_at' => $booking->updated_at,
               ];
           }, $bookings),
           'pagination' => [
               'total' => $this->resource->total(),
               'per_page' => $this->resource->perPage(),
               'current_page' => $this->resource->currentPage(),
               'last_page' => $this->resource->lastPage(),
               'next_page_url' => $this->resource->nextPageUrl(),
               'prev_page_url' => $this->resource->previousPageUrl(),
           ],
       ];

    }
}
