<?php


if ( ! function_exists('get_deleted_items'))
{

    function get_deleted_items($initial_items=array(), $new_items = array())
    {
        $deleted_ids = array();

        if(count($new_items) == 0){
            return $initial_items;
        }

        foreach($initial_items as $item){

            if(!in_array($item, $new_items)){
                $deleted_ids[] = $item;
            }

        }

        return $deleted_ids;
    }
}
