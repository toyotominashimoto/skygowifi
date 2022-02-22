<?php

namespace App\Domains\User\Actions;
use App\Domains\City\DTO\CityDTO\CreateCityData;
use App\Domains\City\DTO\CityDTO\UpdateCityData;

class CityAction
{
    /**
     * create user
     * @param CreateUserData $data
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
        abort_unless((bool)$city, 404, 'city not found');

        $city->country_id = $data->country_id;
        $city->name = $data->name;
        $city->id = $data->id;
        $city->save();

        return $city;
    }
}
