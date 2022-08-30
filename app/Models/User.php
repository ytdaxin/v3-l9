<?php

namespace App\Models;

use DateTimeInterface as DateTimeInterfaceAlias;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = 'user';
    public $primaryKey = 'id';
    const CREATED_AT = 'add_time';
    const UPDATED_AT = 'up_time';
    protected $hidden = [
        'pass'
    ];

    /**
     * 处理时间格式
     * @param DateTimeInterfaceAlias $date
     * @return string
     */
    protected function serializeDate(DateTimeInterfaceAlias $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }
}
