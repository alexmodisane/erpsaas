<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Wallo\FilamentCompanies\FilamentCompanies;

class Items extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_id',
        'sku',
        'description',
        'brand_name',
        'item_price',
        'item_amount',
        'created_by',
        'updated_by'
    ];

    public function user(): BelongsTo 
    {
        return $this->belongsTo(User::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(FilamentCompanies::companyModel(), 'company_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(FilamentCompanies::userModel(), 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(FilamentCompanies::userModel(), 'updated_by');
    }
}
