<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'username' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at->diffForHumans(),
            'role' => $this->role->name,
            'avatar' => $this->avatar ? env('APP_URL').'images/'.$this->photo->path : null,
            'is_active' => $this->is_active ? __('admin/general.yes') : __('admin/general.no')
        ];
    }
}
