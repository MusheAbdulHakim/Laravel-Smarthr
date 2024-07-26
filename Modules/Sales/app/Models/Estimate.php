<?php

namespace Modules\Sales\Models;

use App\Models\User;
use Modules\Project\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Modules\Sales\Database\Factories\EstimateFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Estimate extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'est_id','client_id','project_id',
        'taxe_id','client_address','billing_address','startDate',
        'expiryDate','tax_amount','discount','note','grand_total','subtotal','status'
    ];

    public function client(){
        return $this->belongsTo(User::class, 'client_id');
    }

    public function project(){
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function tax(){
        return $this->belongsTo(Tax::class, 'taxe_id');
    }
    
    public function items(){
        return $this->hasMany(EstimateItem::class);
    }

    public function getgrandTotalAttribute()
    {
        $subTotal = $this->items()->sum('total');
        $taxes = 0;
        if(!empty($this->tax_id)){
            $taxes = $this->tax->percentage * $subTotal;
        }
        return $taxes+$subTotal;
    }

    protected static function newFactory(): EstimateFactory
    {
        return EstimateFactory::new();
    }
}
