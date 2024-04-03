<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'group_id',
        'sub_group_id',
        'department_title', // Add department_title to fillable fields
        'group_title', // Add group_title to fillable fields
        'sub_group_title', // Add sub_group_title to fillable fields
        'si_upc',
        'barcode_sku',
        'product_name',
        'product_description',
        'packsize',
        'unit_price',
        'case_price',
        'rsp',
        'vat',
        'por',
        'bcqty_1',
        'bcp_1',
        'por_1',
        'bcqty_2',
        'bcp_2',
        'por_2',
        'bcqty_3',
        'bcp_3',
        'por_3',
        'status',
        'trending',
        'featured',
        'monthly_offer', // Add monthly_offer to fillable fields
        'weekly_offer', // Add weekly_offer to fillable fields
        'seasonal_offer', // Add seasonal_offer to fillable fields
    ];

    protected $casts = [
        'trending' => 'boolean',
        'featured' => 'boolean',
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function subGroup(): BelongsTo
    {
        return $this->belongsTo(SubGroup::class, 'sub_group_id');
    }

    public function productImages(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function productThumbnails(): HasMany
    {
        return $this->hasMany(ProductThumbnail::class);
    }
}
