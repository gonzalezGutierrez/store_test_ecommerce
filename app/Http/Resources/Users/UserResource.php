<?php

namespace App\Http\Resources\Users;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public static $wrap = false;
    public function toArray($request)
    {
        return [
            'type'=>'users',
            'id'=>$this->id,
            'fullname'=>$this->name,
            'email'=>$this->email,
            'created_at'=>$this->created_at,
            'role'=>$this->role->name,
            'links'=>[
                'self'=>route('users.show',$this)
            ]
        ];
    }
}
