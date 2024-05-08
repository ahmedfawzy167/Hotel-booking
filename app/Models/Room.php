<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
class Room extends Model implements Searchable
{
    use SoftDeletes;
    protected $fillable = ['room_number','type','price','hotel_id'];

    use HasFactory;

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('bookings.show', $this->id);

        return new SearchResult(
            $this,
            $this->room_number,
            $url
        );
    }


}
