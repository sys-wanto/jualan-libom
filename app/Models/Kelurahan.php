<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelurahan extends Model
{
    use HasFactory, SoftDeletes;
    public $incrementing = false;
    protected  $primaryKey = ['kd_propinsi', 'kd_dati2', 'kd_kecamatan','kd_kelurahan'];
    protected $table = 'kelurahan';

    protected $fillable = [
        'kd_propinsi',
        'kd_dati2',
        'kd_kecamatan',
        'kd_kelurahan',
        'nm_kelurahan'
    ];

    protected $hidden = [
        //
        'updated_at',
        'created_at'
    ];

    protected $appends = ['kd_propinsi_new', 'kd_dati2_new','kd_kecamatan_new','kd_kelurahan_new'];
    public function getkdpropinsinewAttribute()
    {
        return ($this->kd_propinsi) ? str_pad($this->kd_propinsi, 2, "0", STR_PAD_LEFT) : str_pad($this->kd_propinsi, 2, "0", STR_PAD_LEFT);
    }
    public function getkddati2newAttribute()
    {
        return ($this->kd_dati2) ? str_pad($this->kd_dati2, 2, "0", STR_PAD_LEFT) : str_pad($this->kd_dati2, 2, "0", STR_PAD_LEFT);
    }
    public function getkdkecamatannewAttribute()
    {
        return ($this->kd_kecamatan) ? str_pad($this->kd_kecamatan, 3, "0", STR_PAD_LEFT) : str_pad($this->kd_kecamatan, 3, "0", STR_PAD_LEFT);
    }
    public function getkdkelurahannewAttribute()
    {
        return ($this->kd_kelurahan) ? str_pad($this->kd_kelurahan, 3, "0", STR_PAD_LEFT) : str_pad($this->kd_kelurahan, 3, "0", STR_PAD_LEFT);
    }
}
