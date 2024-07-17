<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserType;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use RTippin\Messenger\Traits\Messageable;
use RTippin\Messenger\Contracts\MessengerProvider;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class User extends Authenticatable implements MessengerProvider
{
    use HasFactory, Notifiable, Messageable;
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
        'is_active', 'lang', 'layout', 'color_scheme',
        'layout_width', 'layout_position', 'topbar_color', 'sidebar_size', 'sidebar_view', 'sidebar_color',
    ];

    public static function getProviderSettings(): array
    {
        return [
            'alias' => 'user',
            'searchable' => true,
            'friendable' => true,
            'devices' => true,
            'default_avatar' => public_path('images/user.jpg'),
            'cant_message_first' => [],
            'cant_search' => [],
            'cant_friend' => [],
        ];
    }

    public function getProviderAvatarColumn(): string
    {
        return 'avatar';
    }

    public function getProviderName(): string
    {
        return strip_tags(ucwords($this->firstname." ".$this->lastname));
    }

    public static function getProviderSearchableBuilder(Builder $query,string $search,array $searchItems)
    {
        $query->where(function (Builder $query) use ($searchItems) {
            foreach ($searchItems as $item) {
                $query->orWhere('firstname', 'LIKE', "%{$item}%")
                    ->orWhere('username','LIKE', "%{$item}%")
                    ->orWhere('lastname', 'LIKE', "%{$item}%");
            }
        })->orWhere('email', '=', $search);
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
