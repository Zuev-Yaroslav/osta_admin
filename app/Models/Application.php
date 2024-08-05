<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function SetCreatedDate() {
        $timestamp = new Carbon($this->created_at, 'Europe/Moscow');
        return $timestamp->format('d.m.Y H:i:s');
    }
}
