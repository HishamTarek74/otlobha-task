<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 */
class Property extends Model
{
    use HasFactory;

    protected $fillable = ['name' , 'address' , 'property_type_id'];

    /**
     * get property type
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(PropertyType::class);
    }

    /**
     * get property fields
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fields(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PropertyField::class);
    }

    public function getPropertyFieldsAsArray()
    {
        $fieldsArray = [];
        foreach ($this->fields as $field) {
            $fieldsArray[$field->name] = $field->value;
        }
        return $fieldsArray;
    }


}
