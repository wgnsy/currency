<?php
namespace Wgnsy\Currency\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyDetails extends Model
{
    use HasFactory;
    protected $fillable = ['currency_id','mid','ask','bid','created_at','updated_at'];
    protected $table = 'currency_details';
    protected $hidden = ['id','currency_id','created_at','updated_at'];
    
    public function currency(){
        return $this->belongsTo(Currency::class,'currency_id');
    }
}
