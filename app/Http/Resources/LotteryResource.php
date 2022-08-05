<?php
  
namespace App\Http\Resources;
  
use Illuminate\Http\Resources\Json\JsonResource;
  
class LotteryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'reference_number' => $this->reference_number,
            'customer_id' => $this->customer_id,
            'company_id' => $this->company_id,
            'number_pattern' => $this->number_pattern,
            'big_bet_amount' => $this->big_bet_amount,
            'small_bet_amount' => $this->small_bet_amount,
            'bet_type' => $this->bet_type,
            'total_amount' => $this->total_amount,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}