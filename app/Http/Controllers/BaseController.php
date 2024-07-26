<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class BaseController extends Controller
{
    
    public $data = [];

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function __get($name)
    {
        return $this->data[$name];
    }


    public function __isset($name)
    {
        return isset($this->data[ $name ]);
    }

    public function __construct()
    {
        parent::__construct();
    }


  
}



