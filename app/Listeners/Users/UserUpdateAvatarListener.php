<?php

namespace App\Listeners\Users;

use Intervention\Image\ImageManagerStatic as Image;
use App\Entities\File;

class UserUpdateAvatarListener
{

    public function handle($event)
    {
        if ($event->avatar) {
            $photo = $event->avatar->getClientOriginalName();
            $name = time() . '_' . $photo;

            $photo = Image::make($event->avatar->getRealPath())->fit(100, 100);
            $photo->save(public_path('images/avatars/' . $name));

            $photo = File::create(['path' => 'avatars/' . $name, 'type' => '1']);

            $event->user->fire_events = false;
            $event->user->update(['avatar' => $photo->id]);
        }
    }
}
