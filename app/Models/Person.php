<?php

namespace App\Models;

use App\Models\Board;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Scopes\ScopePerson;
use Illuminate\Database\Eloquent\Collection;
use Laravel\Scout\Searchable;

class Person extends Model
{
    use HasFactory;
    use Searchable;

    protected $guarded = array('id');

    public static $rules = array(
        'name' => 'required',
        'mail' => 'email',
        'age' => 'integer|min:0|max:150',
    );

    public function getData()
    {
        return $this->id . ': ' . $this->name . ' (' . $this->age . ')';
    }

    public function scopeNameEqual($query, $str)
    {
        return $query->where('name', $str);
    }

    public function scopeAgeGreaterThan($query, $n)
    {
        return $query->where('age', '>=', $n);
    }

    public function scopeAgeLessThan($query, $n)
    {
        return $query->where('age', '<=', $n);
    }

    protected static function boot()
    {
        parent::boot();

        // static::addGlobalScope(new ScopePerson);
        // static::addGlobalScope('age', function (Builder $builder) {
        //     $builder->where('age', '>', 20);
        // });
    }

    public function boards()
    {
        return $this->hasMany('App\Models\Board');
    }

    public function newCollection(array $models = [])
    {
        return new MyCollection($models);
    }

    // Accessor
    public function getNameAndIdAttribute()
    {
        return $this->name . ' [id: ' . $this->id . ']';
    }
    public function getNameAndMailAttribute()
    {
        return $this->name . ' (' . $this->mail . ')';
    }
    public function getNameAndAgeAttribute()
    {
        return $this->name . '(' . $this->age . ')';
    }
    public function getAllDataAttribute()
    {
        return $this->name . '(' . $this->age . ')' . ' (' . $this->mail . ')';
    }
    public function getNameAttribute($value)
    {
        return strtoupper($value);
    }

    // Mutator
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtoupper($value);
    }
    public function setAllDataAttribute(Array $value)
    {
        $this->attributes['name'] = $value[0];
        $this->attributes['mail'] = $value[1];
        $this->attributes['age'] = $value[2];
    }
}

class MyCollection extends Collection
{
    public function fields()
    {
        $item = $this->first();
        return array_keys($item->toArray());
    }
}
