<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Category extends Model implements Searchable
{
    use SoftDeletes;

    // for cascading soft deletes
    protected static $relations_to_cascade = ['products'];

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($resource) {
            foreach (static::$relations_to_cascade as $relation) {
                foreach ($resource->{$relation}()->get() as $item) {
                    $item->delete();
                }
            }
        });

        static::restoring(function ($resource) {
            foreach (static::$relations_to_cascade as $relation) {
                foreach ($resource->{$relation}()->get() as $item) {
                    $item->withTrashed()->restore();
                }
            }
        });
    }
    //

    //returns an accessible http url for the asset from the storage path stored in database
    public function getImageAttribute($value)
    {
        if ($value) {
            return asset('storage/' . $value);
        }
    }

    public function products()
    {
        return $this->hasMany(Product::class)->withTrashed();
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('category.show', $this->id);

        // TODO: Implement getSearchResult() method.
        return new SearchResult($this, $this->name, $url);
    }
}
