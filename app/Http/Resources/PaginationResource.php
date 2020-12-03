<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaginationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);

        return [
            'data' => $this->data,
            'links'=>[
                "first"=>$this->first_page_url,
                "last"=> $this->last_page_url,
                "prev"=> $this->prev_page_url,
                "next"=> $this->next_page_url
            ],
            'payload' => $request->all(),
            "meta"=> [
                "current_page"=> $this->current_page,
                "from"=> $this->from,
                "last_page"=> $this->last_page,
                "path"=> $this->path,
                "per_page"=> $this->per_page,
                "to"=> $this->to,
                "total"=> $this->total
            ]
        ];
    }
}
