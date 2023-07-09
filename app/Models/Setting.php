<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    const CONF_CSV_MAPPING = 'CSV_MAPPING';
    const CONF_SHOPIFY_SETTING = 'SHOPIFY_SETTINGS';

    const OPT_PLACEHOLDER = 'placeholder';
    const OPT_DESCRIPTION = 'description';

    protected $fillable = [
        'key',
        'value',
        'parent_id',
        'application_level',
    ];

    /**
     * Get the serialized options attribute.
     *
     * @param  mixed  $value
     * @return string|null
     */
    public function getOptionsAttribute($value)
    {
        return $value ? json_decode($value, true) : null;
    }

    /**
     * Set the serialized options attribute.
     *
     * @param  mixed  $value
     * @return void
     */
    public function setOptionsAttribute($value)
    {
        $this->attributes['options'] = $value ? json_encode($value) : null;
    }

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
        if ($this->settings()->exists()) {
            throw new \Exception('This setting group cannot be deleted since it has list of settings');
        }
        return parent::delete();
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_setting')->withTimestamps();
    }

    public function store()
    {
        return $this->belongsToMany(Store::class, 'store_settings')->withTimestamps();
    }

    public function getSettingsByParent($parent_key)
    {
        return $this->whereHas('settingGroup', function ($query) use ($parent_key) {
            $query->where('key', $parent_key);
        })->get();
    }

    public static function getSettingByKey($key)
    {
        return self::where('key', $key)->first();
    }

    public static function getMarkeplaceConfigParentKeys()
    {
        return array(
            self::CONF_SHOPIFY_SETTING,
        );
    }

    public static function getMarketplaceConfigParents()
    {
        $marketplaceConfigParentKeys = self::getMarkeplaceConfigParentKeys();
        return Setting::whereIn('key', $marketplaceConfigParentKeys)->get();
    }
}
