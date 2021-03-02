<?php

namespace App\traits;

use Illuminate\Support\Arr;

trait RandomizerTrait
{
    public function RandomPicker(array $data) // decision maker & namepicker & random picker
    {
        $randomIndex = array_rand($data);
        $newData = $data;

        return $newData[$randomIndex];
    }

    public function CustomList(array $data)
    {
        shuffle($data);
        return $data;
    }

    public function TeamGenerator(array $data, int $qty)
    {
        // for ($i = 0; $i < $qty; ++$i) {
        //     $newData[$i] = $this->RandomPicker($data);
        // }
        shuffle($data);
        $newArray = array_chunk($data, $qty);

        return $newArray;
    }


    public function getRandomizer($arr)
    {
        $type = $arr['type'];
        $result = array();

        switch ($type) {
            case 1:
                $result = [$this->RandomPicker($arr['data']['items'])];
                break;   //Name Picker
            case 2:
                $result = $this->CustomList($arr['data']['items']);
                break;   //Custom List
            case 3:
                $result = [$this->RandomPicker($arr['data']['items'])];
                break;   //Decision Maker
            case 4:
                $result = [$this->RandomPicker($arr['data']['items'])];
                break;   //Random Picker
            case 5:
                $result = $this->TeamGenerator($arr['data']['items'], $arr['data']['qty']);
                break;   //Team Generator
            case 6:
                if (array_rand([0, 1]) === 1) return $result = ["Yes"];
                return $result = ["No"];
                break;   //Yes No
            default:
                break;
        }


        return $result;
    }
}


// "items" : ["name", "John" , "Jenny", "Lucifer", "Boom", "asdf", "asdfas", "asdfa"],
// "qty" : 3
