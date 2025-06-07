<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Peta
 * @package App\Models
 * @version February 28, 2024, 8:09 am UTC
 *
 * @property string $nomor
 * @property string $keterangan
 * @property string $jenis_lokasi
 * @property string $x
 * @property string $y
 */
class Peta extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'petas';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nomor',
        'keterangan',
        'jenis_lokasi',
        'x',
        'y'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nomor' => 'string',
        'keterangan' => 'string',
        'jenis_lokasi' => 'string',
        'x' => 'string',
        'y' => 'string'
    ];

    public function jenisLokasi(): BelongsTo
    {
        return $this->belongsTo(JenisLokasi::class, 'jenis_lokasi');
    }

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        //
    ];


}
