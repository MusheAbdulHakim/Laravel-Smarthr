<?php

namespace Modules\Project\Models;

use App\Models\User;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Project\Database\Factories\ProjectFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Project extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name','client_id','short_desc','startDate','endDate','rate','rateType','priority','leader_id','description',
        'created_by'
    ];


    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }


    /**
     * Owner of the project / client
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    /**
     * Employee to lead the project (main leader)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function leader(){
        return $this->belongsTo(User::class,'leader_id');
    }

    public function createdBy(){
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Employees chosen to lead the project
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lead(){
        return $this->hasMany(ProjectLead::class);
    }

    /**
     * Employees chosen to work on the project
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function team()
    {
        return $this->hasMany(ProjectTeam::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function taskBoard()
    {
        return $this->hasMany(ProjectTaskBoard::class);
    }

    protected static function newFactory(): ProjectFactory
    {
        return ProjectFactory::new();
    }
}
