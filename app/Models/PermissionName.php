<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionName extends Model
{
    use HasFactory;
    public static $admin = 'admin';
    public static $company = 'company';
    public static $store = 'store';
    public static $sanctum='sanctum';
}
