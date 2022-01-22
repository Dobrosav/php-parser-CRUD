<?php


namespace App\Controllers;



class ReservationController extends BaseController
{
    public function index(){
        $k=$this->doctrine->em->getRepository(Grad::class)->findAll();
        echo view('index',['gradovi'=>$k]);
    }

    public function reserve(){

    }
}