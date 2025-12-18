<?php

namespace atikullahnasar\setting\Models;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'beft_settings';
    protected $fillable = ['user_id', 'key', 'value'];
    protected $casts = ['value' => 'array'];
}
