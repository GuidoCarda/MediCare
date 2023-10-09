<?php


class HomeController
{
  public static function list()
  {
    return [
      'data' => [],
      'view' => 'landing'
    ];
  }

  
  public static function contact()
  {
    return [
      'data' => [],
      'view' => 'contact'
    ];
  }
}
