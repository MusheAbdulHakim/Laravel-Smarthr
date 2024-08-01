<?php

namespace App\Http\Controllers\Vendor\Chatify;

use Chatify\ChatifyMessenger;

class CustomChatify extends ChatifyMessenger
{

    /**
     * Get user with avatar (formatted).
     *
     * @param Collection $user
     * @return Collection
     */
    public function getUserWithAvatar($user)
    {
        if ($user->avatar == 'avatar.png' && config('chatify.gravatar.enabled')) {
            $imageSize = config('chatify.gravatar.image_size');
            $imageset = config('chatify.gravatar.imageset');
            $user->avatar = 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($user->email))) . '?s=' . $imageSize . '&d=' . $imageset;
        } else {
            $user->avatar = $this->getUserAvatarUrl($user->avatar);
        }
        return $user;
    }

    /**
     * Get user avatar url.
     *
     * @param string $user_avatar_name
     * @return string
     */
    public function getUserAvatarUrl($user_avatar_name)
    {
        return !empty($user_avatar_name) ? uploadedAsset($user_avatar_name,'users'): asset('images/user.jpg');
    }
    

}