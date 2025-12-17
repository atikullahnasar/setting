<?php

namespace atikullahnasar\setting\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class CustomPage extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'beft_custom_pages';

    protected $fillable = [
        'title',
        'slug',
        'content',
        'enabled',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($page) {
            $page->slug = Str::slug($page->title); // 🔹 generate slug
        });

        static::updating(function ($page) {
            if ($page->isDirty('title')) {
                $page->slug = Str::slug($page->title);
            }
        });
    }

    public function toggleStatus(): bool
    {
        $this->enabled = !$this->enabled;
        return $this->save();
    }
}
