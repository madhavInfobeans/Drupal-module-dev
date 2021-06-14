<?php
namespace Drupal\infobeans_employee\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;

class EmployeeController extends ControllerBase
{
 public function createEmployee()
 {
  $form = \Drupal::formBuilder()->getForm('Drupal\infobeans_employee\Form\EmployeeForm');
  // $renderForm = \Drupal::service('renderer')->render($form);

  return [
   '#theme' => 'infobeans_employee',
   '#items' => $form,
   #'#type' => 'markup',
   #'#markup' => $form,
   #'#title' => 'Employee Data Submission Form',
  ];
 }
 public function getEmployeeList()
 {
  $query = \Drupal::database();
  $result = $query->select('infobeans', 'e')
   ->fields('e', ['id', 'fname', 'lname', 'gender', 'about_employee'])
   ->execute()->fetchAll(\PDO::FETCH_OBJ);

  $data = [];
  $count = 1;
  foreach ($result as $row) {
   $data[] = [
    'serial_no' => $count . ".",
    'fname' => $row->fname,
    'lname' => $row->lname,
    'gender' => $row->gender,
    'about_employee' => $row->about_employee,
    'Edit' => 'Edit',
    'Delete' => 'Delete',
   ];
   $count++;
  }

  $header = array('S_No', 'First Name', 'Last Name', 'Gender', 'About', 'Edit', 'Delete');

  $build['table'] = [
   '#type' => 'table',
   '#header' => $header,
   '#rows' => $data,
  ];

  return [
   $build,
   '#title' => "Infobeans Employee List",
  ];

 }
}
