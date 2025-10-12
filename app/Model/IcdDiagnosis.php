<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IcdDiagnosis extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code',
        'description'
    ];

    // Relationship: one ICD diagnosis can be linked to many prescriptions
    public function prescriptions()
    {
        return $this->hasMany(Prescription::class, 'icd_diagnosis_id');
    }

    // Optional: to easily show combined label
    public function getLabelAttribute()
    {
        return "{$this->code} - {$this->description}";
    }
}
