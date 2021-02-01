<?php namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $table = 'siswa';
    protected $primaryKey = 'nisn';
    protected $allowedFields = ['nisn','name','address'];
}