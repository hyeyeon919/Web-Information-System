<?php

namespace App\Controllers;

class Authorize extends BaseController
{
    public function verifyEmail($token)
    {
        $model = model('App\Models\User_model');
        $model->emailverification($token);
    }
    public function setnewPassword($token) {
        $model = model('App\Models\User_model');
        $model->setnewPassword($token);
    }
}