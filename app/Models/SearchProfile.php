<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchProfile extends Model
{
    use HasFactory;

    protected $fillable =['name','property_type_id'];


    /**
     * Get the Property type .
     */
    public function type(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(PropertyType::class);
    }
    /**
     * Get the Property  Fields .
     */
    public function fields(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(SearchField::class);
    }

    public function getSearchFieldsAsArray()
    {
        $fieldsArray = [];
        foreach ($this->fields as $field) {
            $fieldsArray[$field->name] =  [
                'min_value' => $field->min_value,
                'max_value' => $field->max_value
            ];
        }
        return $fieldsArray;
    }
}
