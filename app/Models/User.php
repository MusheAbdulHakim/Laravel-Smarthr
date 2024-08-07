<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserType;
use App\Models\AttendanceTimestamp;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use \Spatie\Permission\Traits\HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'email',
        'username',
        'type',
        'password',
        'address',
        'country',
        'country_code',
        'dial_code', 'phone',
        'avatar',
        'created_by',
        'is_active','is_online', 'lang', 'layout', 'color_scheme',
        'layout_width', 'layout_position', 'topbar_color', 'sidebar_size', 'sidebar_view', 'sidebar_color',
    ];

   
    public function chatMessages()
    {
        return $this->hasMany(ChatMessage::class, 'user_id');
    }
   
    public function assets()
    {
        return $this->hasMany(Asset::class, 'user_id');
    }

    public function family(){
        return $this->hasMany(UserFamilyInfo::class,'user_id');
    }

    public function employeeDetail(){
        return $this->hasOne(EmployeeDetail::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'user_id');
    }

    public function attendanceTimestamps()
    {
        return $this->hasMany(AttendanceTimestamp::class,'user_id');
    }

    public function clientDetail(){
        return $this->hasOne(ClientDetail::class);
    }

    public function getNameAttribute()
    {
        return "$this->firstname $this->middlename $this->lastname";
    }
    public function getFullNameAttribute()
    {
        return $this->getNameAttribute();
    }

    public function getPhoneNumberAttribute()
    {
        return "$this->dial_code $this->phone";
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'type' => UserType::class,
        ];
    }

    public function hasVerifiedPhone()
    {
        return !empty($this->phone_verified_at);
    }
}
