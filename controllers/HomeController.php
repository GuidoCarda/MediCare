<?php

namespace controllers;

class HomeController{
  public static function list(){
    return [
      'data'=> [],
      'view'=> 'landing'
    ];
  }
}