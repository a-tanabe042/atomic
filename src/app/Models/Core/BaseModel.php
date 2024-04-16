<?php

namespace App\Models\Core;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    /**
     * convert collection to array.
     * @param mixed $_data
     * @return array
     */
    protected function _convertArray($_data): array
    {
        if (is_null($_data)) {
            return [];
        }
        return json_decode(json_encode($_data), true);
    }
}
