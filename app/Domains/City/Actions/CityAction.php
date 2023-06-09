<?php

namespace App\Domains\City\Actions;
use App\Domains\City\DTO\CityDTO\CreateCityData;
use App\Domains\City\DTO\CityDTO\UpdateCityData;
use App\Domains\City\Models\City;
class CityAction
{
    /**
     * create user
     * @param CreateCityData $data
     * @return mixed
     */
    public function create(CreateCityData $data)
    {
        return City::create([
            'name' => $data->name,
            'country_id' => $data->country_id,
        ]);
    }

    public function update(UpdateCityData $data)
    {
        $city = City::find($data->id);
        abort_unless((bool)$city, 404, 'City not found');

        $city->country_id = $data->country_id;
        $city->name = $data->name;
        $city->save();

        return $city;
    }
    public function delete($city_id){
        $city = City::find($city_id);
        abort_unless((bool)$city, 404, 'City not found');
        $city->delete();
        return $city;
    }
}
