<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Propinsi extends Model
{
    use HasFactory, SoftDeletes;
    protected  $primaryKey = 'kd_propinsi';
    protected $table = 'propinsi';

    protected $fillable = [
        'kd_propinsi',
        'nm_propinsi'
    ];

    protected $appends = ['kd_propinsi_new'];
    public function getkdpropinsinewAttribute()
    {
        return ($this->kd_propinsi) ? str_pad($this->kd_propinsi, 2, "0", STR_PAD_LEFT) : str_pad($this->kd_propinsi, 2, "0", STR_PAD_LEFT);
    }
}
