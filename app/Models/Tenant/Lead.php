<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\TenantOwner;

class Lead extends Model
{   
    use HasFactory, TenantOwner;
}
