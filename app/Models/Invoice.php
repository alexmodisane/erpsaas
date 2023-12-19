<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Wallo\FilamentCompanies\FilamentCompanies;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'user_id',
        'customer_id',
        'invoice_date',
        'invoice_number',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(FilamentCompanies::companyModel(), 'company_id');
    }

    public function user(): BelongsTo 
    {
        return $this->belongsTo(User::class);
    }

    public function customer(): BelongsTo 
    {
        return $this->belongsTo(Customer::class);
    }

    public function invoiceItems(): HasMany
    {
        return $this->hasmany(Invoice_Item::class);
    }
}
