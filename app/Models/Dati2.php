<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dati2 extends Model
{
    use HasFactory, SoftDeletes;
    public $incrementing = false;
    protected  $primaryKey = ['kd_propinsi','kd_dati2'];
    protected $table = 'dati2';

    protected $fillable = [
        'kd_propinsi',
        'kd_dati2',
        'nm_dati2'
    ];

    protected $hidden = [
        //
        'updated_at',
        'created_at'
    ];

    protected $appends = ['kd_propinsi_new','kd_dati2_new'];
    public function getkdpropinsinewAttribute()
    {
        return ($this->kd_propinsi) ? str_pad($this->kd_propinsi, 2, "0", STR_PAD_LEFT) : str_pad($this->kd_propinsi, 2, "0", STR_PAD_LEFT);
    }
    public function getkddati2newAttribute()
    {
        return ($this->kd_dati2) ? str_pad($this->kd_dati2, 2, "0", STR_PAD_LEFT) : str_pad($this->kd_dati2, 2, "0", STR_PAD_LEFT);
    }

}
