<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HotelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $hotels = $this->resource->items();

        return [
           'status' => 200,
           'data' => array_map(function ($hotel) {
               return [
                   'id' => $hotel->id,
                   'name' => $hotel->name,
                   'description' => $hotel->description,
                   'address' => $hotel->address,
                   'image' => $hotel->images,
                   'created_at' => $hotel->created_at,
                   'updated_at' => $hotel->updated_at,
               ];
           }, $hotels),
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
