<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
class Booking extends Model implements Searchable
{
    protected $fillable = ['check_in_date','check_out_date','status','user_id','hotel_id'];

    use HasFactory;

    public function hotel()
    {
       return $this->belongsTo(Hotel::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('bookings.show', $this->id);

        return new SearchResult(
            $this,
            $this->check_in_date,
            $url
        );
    }


}
