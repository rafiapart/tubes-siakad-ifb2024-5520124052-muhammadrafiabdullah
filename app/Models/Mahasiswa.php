<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'npm';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['npm', 'nidn', 'nama'];

    public function getRouteKeyName(): string
    {
        return 'npm';
    }

    /**
     * Dosen wali / pembimbing akademik mahasiswa ini.
     */
    public function dosenWali()
    {
        return $this->belongsTo(Dosen::class, 'nidn', 'nidn');
    }

    /**
     * Daftar KRS (mata kuliah yang diambil) mahasiswa ini.
     */
    public function krs()
    {
        return $this->hasMany(Krs::class, 'npm', 'npm');
    }

    /**
     * Akun login milik mahasiswa ini (jika ada).
     */
    public function user()
    {
        return $this->hasOne(User::class, 'npm', 'npm');
    }
}
