<?php

namespace laratube;
use laratube\Subscription;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;



class Channel extends Model implements HasMedia
{
    use HasMediaTrait;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function image()
    {
        if($this->media->first())
        {
            return $this->media->first()->getFullUrl('thumb');
        }
        return null;
       
    }

    public function editable()
    {
        if(!auth()->check()) return false;
        return $this->user_id === auth()->user()->id;
    }

    public function registerMediaConversions(?Media $media = null)
    {
        $this->addMediaConversion('thumb')
        ->width(100)
        ->height(100);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
