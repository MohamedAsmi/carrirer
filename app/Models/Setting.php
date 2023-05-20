<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'value',
        'parent_id',
        'application_level',
    ];

    public function settings()
    {
        return $this->hasMany(Setting::class, 'parent_id');
    }

    public function settingGroup()
    {
        return $this->belongsTo(Setting::class, 'parent_id');
    }

    public function delete()
    {
        if($this->settings()->exists()){
            throw new \Exception('This setting group cannot be deleted since it has list of settings');
        }
        return parent::delete();
    }
}
