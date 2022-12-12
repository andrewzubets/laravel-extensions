<?php

namespace Azub\Library\Model\Traits;

trait Search {

    public function scopeSearch($query, $value, $properties = ['title']){

        $sql_eq = '';
        $sql_left = '';
        $sql_right = '';
        $sql_middle = '';
        $binds = [

        ];

        $prop_count = count($properties);
        for ($i = 0; $i < $prop_count; $i++){
            if($i != 0) {
                $sql_eq .= ' or ';
            }
            $property_id = $properties[$i];

            $sql_eq.= $property_id . ' = ?';
            $binds[]=$value;
        }
        for ($i = 0; $i < $prop_count; $i++){
            if($i != 0) {

                $sql_left .= ' or ';

            }
            $property_id = $properties[$i];


            $sql_left.= $property_id . ' like ?';
            $binds[]=$value.'%';

        }
        for ($i = 0; $i < $prop_count; $i++){
            if($i != 0) {

                $sql_right .= ' or ';

            }
            $property_id = $properties[$i];


            $sql_right.= $property_id . ' like ?';
            $binds[]='%'.$value;
        }
        for ($i = 0; $i < $prop_count; $i++){
            if($i != 0) {

                $sql_middle .= ' or ';
            }
            $property_id = $properties[$i];

            $sql_middle.= $property_id . ' like ?';
            $binds[]='%'.$value.'%';

        }
        $sql = ' ('.$sql_eq.') or ('.$sql_left.') or ('.$sql_middle.') or ('.$sql_right.') ';
        return $query->whereRaw($sql,$binds);
    }
	public function scopeSearchLower($query, $value, $properties = ['title']){
        $value = mb_strtolower($value);

        $sql_eq = '';
        $sql_left = '';
        $sql_right = '';
        $sql_middle = '';
        $binds = [

        ];

        $prop_count = count($properties);
        for ($i = 0; $i < $prop_count; $i++){
            if($i != 0) {
                $sql_eq .= ' or ';
            }
            $property_id = $properties[$i];

            $sql_eq.= 'lower(' . $property_id . ') = ?';
            $binds[]=$value;
        }
        for ($i = 0; $i < $prop_count; $i++){
            if($i != 0) {

                $sql_left .= ' or ';

            }
            $property_id = $properties[$i];


            $sql_left.= 'lower(' . $property_id . ') like ?';
            $binds[]=$value.'%';

        }
        for ($i = 0; $i < $prop_count; $i++){
            if($i != 0) {

                $sql_right .= ' or ';

            }
            $property_id = $properties[$i];


            $sql_right.= 'lower(' . $property_id . ') like ?';
            $binds[]='%'.$value;
        }
        for ($i = 0; $i < $prop_count; $i++){
            if($i != 0) {

                $sql_middle .= ' or ';
            }
            $property_id = $properties[$i];

            $sql_middle.= 'lower(' . $property_id . ') like ?';
            $binds[]='%'.$value.'%';

        }
        $sql = ' ('.$sql_eq.') or ('.$sql_left.') or ('.$sql_middle.') or ('.$sql_right.') ';
        return $query->whereRaw($sql,$binds);
    }
}
