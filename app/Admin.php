<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends User
{



    public function esAdmin(){
        if ($this->admin = true){
            return true;
        }else{
            return false;
        }
    }
}
