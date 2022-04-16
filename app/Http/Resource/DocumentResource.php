<?php

namespace App\Http\Resource;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class DocumentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'document_code' => $this->document_code,
            'status_name' => $this->status_name,
            'data' => $this->data,
            'is_workflow' => $this->is_workflow,
            'is_otp' => $this->is_otp,
            'created_by'=> UserViewResource::collection(DB::table('account')->where('id','=', $this->created_by_id)->get()),
            'modified_by'=>UserViewResource::collection(DB::table('account')->where('id','=', $this->modified_by_id)->get())
        ];
    }
}
