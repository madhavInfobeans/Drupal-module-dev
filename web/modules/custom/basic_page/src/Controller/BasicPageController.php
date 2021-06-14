<?php
namespace Drupal\basic_page\Controller;

use Drupal\Core\Controller\ControllerBase;

class BasicPageController extends ControllerBase
{
 public function basicPage()
 {
  return [
   '#title' => 'Custome Module 1 Basic Page Information',
   '#markup' => '<h2>This is my first custom module development in drupal 9 created by author name: Madhav Page </h2>'];
 }

 public function information()
 {
  $data = array(
   'name' => "Madhav Rajput",
   'email' => "madhavrajput.1996@gmail.com",
   'description' => 'This is a Information page for Custom module 2 on drupal 9',
  );
  return [
   '#title' => "Custom Module 2 Information Page",
   '#theme' => 'information_page',
   '#items' => $data,
  ];
 }
}
