<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'account_id',
        'type',
        'amount',
        'description',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = (string) Str::uuid(); // Generate UUID before saving
            }
        });
    }
    
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
