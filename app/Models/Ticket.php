<?php

namespace App\Models;

use App\Enums\TicketStatus;
use App\Models\TicketReply;
use App\Enums\GeneralPriority;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'tk_id','subject','created_by','user_id',
        'description','status','priority','endDate'
    ];

    protected $casts = [
        'priority' => GeneralPriority::class,
        'status'   => TicketStatus::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function replies()
    {
        return $this->hasMany(TicketReply::class);
    }
}
