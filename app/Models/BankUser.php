<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name', 'middle_name', 'last_name', 'occupation', 'balance', 'is_deleted'
    ];

    // Accessor to get the full name
    public function getNameAttribute()
    {
        return trim("{$this->first_name} {$this->middle_name} {$this->last_name}");
    }

    // Scope to filter out soft-deleted users
    public function scopeActive($query)
    {
        return $query->where('is_deleted', false);
    }

    // Soft delete method
    public function softDelete()
    {
        $this->update(['is_deleted' => true]);
    }

    // Restore method
    public function restore()
    {
        $this->update(['is_deleted' => false]);
    }
}
