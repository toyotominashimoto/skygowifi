<?php

namespace App\Domains\Device\Gateways;

use App\Domains\Device\Models\Device;
use App\Traits\BasicGatewaysTrait;

class DeviceGateway
{
    use BasicGatewaysTrait;
    /**
     * get devices by set filters
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    protected function appendFilters($query)
    {
        if (array_key_exists('start_created_at', $this->filters)) {
            $query->where('created_at', '>=', $this->filters['start_created_at']);
        }

        if (array_key_exists('end_created_at', $this->filters)) {
            $query->where('created_at', '<=',  $this->filters['end_created_at']);
        }

        return $query;
    }
    public function all(){        
        $query = Device::query();        
        if ($this->search['keywords'] && count($this->search['columns'])) {
            $this->appendSearch($query);
        }
        
        if(count($this->filters)){
            $query = $this->appendFilters($query);
        }
        
        if ($this->paginate) {
            return $query->paginate($this->paginate);
        }
        return $query->get(); 
    }

    public function edit($id){
        $device = Device::find($id);
        return $device;
    }
    public function find($id){
        return Device::find($id);
    }
}
