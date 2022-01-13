<?php
namespace Wgnsy\Currency\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    protected $fillable = ['code'];
    protected $table = 'currency';
    public $timestamps = false;
    protected $appends = ['details'];
    protected $hidden = ['id'];

    public static function boot() {
        parent::boot();

        static::deleting(function($currency) {
            $currency->details()->get()->each->delete();
        });
    }

    public function details(){
        return $this->hasMany(CurrencyDetails::class,'currency_id');
    }
    public function getDetailsAttribute(){
        return $this->details()->get();
    }
}
