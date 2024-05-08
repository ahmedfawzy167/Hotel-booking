<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
class Hotel extends Model implements Searchable
{
    use SoftDeletes;
    protected $fillable = ['name','description','address'];

    use HasFactory;

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function setNameAttribute($value)
    {
       $this->attributes['name'] = strtolower($value);  // Convert The name to Lowercase;
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class,'imageable');
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('hotels.show', $this->id);

        return new SearchResult(
            $this,
            $this->name,
            $url
        );
    }


}
