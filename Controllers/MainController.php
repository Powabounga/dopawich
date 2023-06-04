<?php

namespace App\Controllers;

class MainController extends Controller{
    public function index(){
        $this->render('main/index', [], 'home');
    }

    public function quiSommesNous(){
        $this->render('main/quisommesnous', []);
    }
    public function participer(){
        $this->render('main/participer', []);
    }
}