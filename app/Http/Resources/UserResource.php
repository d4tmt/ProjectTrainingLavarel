<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
//        return parent::toArray($request);
        return [
            'id' => $this->id,
            'username'=>$this->username,
            'firstname'=>$this->firstname,
            'lastname'=>$this->lastname,
            'date_of_birth'=>$this->date_of_birth,
            'address'=>$this->address,
            'email'=>$this->email,
            'state' => $this->state,
            'created_at' =>$this->created_at,
            'updated_at'=>$this->updated_at,
        ];
    }
}
