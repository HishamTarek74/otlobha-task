<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchField extends Model
{
    use HasFactory;

    protected $fillable =['name','min_value','max_value','search_profile_id'];

    /**
     * Get the Profile.
     */
    public function profile(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(SearchProfile::class);
    }
}
