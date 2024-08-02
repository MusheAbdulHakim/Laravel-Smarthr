<?php

namespace Modules\Sales\Models;

use App\Models\User;
use Modules\Project\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Modules\Sales\Database\Factories\InvoiceFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'inv_id','client_id','project_id',
        'taxe_id','client_address','billing_address','startDate',
        'expiryDate','tax_amount','discount','grand_total','subtotal','note','status'
    ];

    public function getstatusNameAttribute()
    {
        $color = 'success';
        $name = __('Sent');
        $status = $this->status;
        if($status == 1){
            $color = 'info';
            $name = __('Sent');
        }
        if($status == 2){
            $color = 'success';
            $name = __('Paid');
        }
        if($status == 3){
            $color = 'warning';
            $name = __('Partially Paid');
        }
        if($status == 4){
            $color = 'danger';
            $name = __('Declined');
        }
        return [
            'name' => $name,
            'color' => $color
        ];
    }

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
        return $this->hasMany(InvoiceItem::class);
    }


    protected static function newFactory(): InvoiceFactory
    {
        return InvoiceFactory::new();
    }
}
