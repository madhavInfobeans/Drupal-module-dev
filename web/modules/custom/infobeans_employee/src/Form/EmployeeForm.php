<?php
namespace Drupal\infobeans_employee\Form;

use Drupal\Core\Database\Database;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class EmployeeForm extends FormBase
{
 /**
  * (@inheritdoc)
  */

 public function getFormId()
 {
  return 'create_employee';
 }

 /**
  * (@inheritdoc)
  */

 public function buildForm(array $form, FormStateInterface $form_state)
 {
  $genderOptions = array(
   //'0' => 'Select Gender',
   'Male' => 'Male',
   'Female' => 'Female',
   'Other' => 'Other',
  );
  $form['fname'] = array(
   '#type' => 'textfield',
   '#title' => t('FirstName'),
   '#default_value' => '',
   '#required' => true,
   '#attributes' => array(
    'placeholder' => 'Your First Name',
   ),
  );
  $form['lname'] = array(
   '#type' => 'textfield',
   '#title' => t('LastName'),
   '#default_value' => '',
   '#required' => true,
   '#attributes' => array(
    'placeholder' => 'Your Last Name',
   ),
  );

  $form['gender'] = array(
   '#type' => 'select',
   '#title' => 'Gender',
   '#options' => $genderOptions,
   '#required' => true,
  );

  $form['about_employee'] = array(
   '#type' => 'textarea',
   '#title' => 'About Employee',
   '#default_value' => '',
   '#required' => true,
   '#attributes' => array(
    'placeholder' => 'Write About Employee',
   ),
  );

  $form['save'] = array(
   '#type' => 'submit',
   '#value' => 'Save Employee',
   '#button_type' => 'primary',
  );

  return $form;

 }

 /**
  * (@inheritdoc)
  */

 public function validateForm(array &$form, FormStateInterface $form_state)
 {
  $fname = $form_state->getValue('fname');
  if (trim($fname) == '') {
   $form_state->setErrorByName('fname', $this->t('First Name is Required'));
  } else if (trim($form_state->getValue('lname')) == '') {
   $form_state->setErrorByName('lname', $this->t('Last Name is Required'));
  } else if ($form_state->getValue('gender') == '0') {
   $form_state->setErrorByName('gender', $this->t('please select gender'));
  } else if ($form_state->getValue('about_employee') == '') {
   $form_state->setErrorByName('about_employee', $this->t('Enter Employee Details'));
  }
 }

 /**
  * (@inheritdoc)
  */

 public function submitForm(array &$form, FormStateInterface $form_state)
 {
  $postData = $form_state->getValues();

  unset($postData['save'], $postData['form_build_id'], $postData['form_token'], $postData['form_id'], $postData['op']);
  $query = \Drupal::database();
  $query->insert('infobeans')->fields($postData)->execute();

  \Drupal::messenger()->addMessage("Employee details saved");

//   echo '<pre>';
  //   print_r($postData);
  //   echo "</pre>";
  //   exit;
 }
}
