<?php

namespace App\Models;

use CodeIgniter\Model;

class Config extends Model
{
    protected $table = 'configs';
    protected $primaryKey = 'id';
    protected $allowedFields = ['key', 'value'];
    
    //
    public function getValue(string $key, $default = null)
    {
        $result = $this->where('key', $key)->first();
        return $result['value'] ?? $default;
    }

    //
    public function setValue(string $key, string $value)
    {
        $existing = $this->where('key', $key)->first();

        if ($existing) {
            return $this->update($existing['id'], ['value' => $value]);
        }

        return $this->insert(['key' => $key, 'value' => $value]);
    }
}
