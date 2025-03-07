<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;



    /**
    * This function return count model
    *
    * @author      Md. Al-Mahmud <mamun120520@gmail.com>
    * @version     1.0
    * @see         
    * @since       11/11/2022
    * Time         08:26:58
    * @param       
    * @return      
    */
    public function totals($model)
    {
        # code...   
        $data['total']= $model::count();
        $data['trashe']= $model::onlyTrashed()->count();
        return $data;
    }
    #end
     
}
