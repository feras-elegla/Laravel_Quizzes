<?php

use Illuminate\Support\Facades\Config;

 function formatTree($root_Categoris, $allCategoris)
{
    foreach($root_Categoris as $category){
        $category->childern= $allCategoris->where('parent_id',$category->id)->values();
      if($category->childern->isNotEmpty()){
       formatTree($category->childern, $allCategoris);
      }

    }
}
function formatTreeGetQuestion($root_Categoris, $allCategoris)
{
    foreach($root_Categoris as $category){
        $category->childern= $allCategoris->where('parent_id',$category->id)->values();
   if($category->childern->isNotEmpty()){
       formatTree($category->childern, $allCategoris);
   }

    }
}

function getCurrentdate(){
    return  date('d-m-y h:i:s');
}
function uploadImage($folder, $image)
{
    $image->store('/', $folder);
    $filename = $image->hashName();
    $path = 'images/'.$folder.'/'.$filename;
    return $path;
}
