<?php

namespace App\Listeners\Users;

use Intervention\Image\ImageManagerStatic as Image;
use App\Models\File;

class UserUpdateAvatarListener
{

    public function handle($event)
    {
        if ($event->avatar) {
            if ($event->user->avatar && $event->user->avatar != "1") {
                unlink(public_path() . '/images/' . $event->user->photo->path);
                $event->user->photo()->delete();
            }

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
