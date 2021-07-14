<?php

namespace Drupal\mydata\Form;

use Drupal\Core\Form\ConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Class DeleteForm.
 *
 * @package Drupal\mydata\Form
 */
class DeleteForm extends ConfirmFormBase
{

 /**
  * {@inheritdoc}
  */
 public function getFormId()
 {
  return 'delete_form';
 }

 public $cid;

 public function getQuestion()
 {
  return t('Do you want to delete %cid?', array('%cid' => $this->cid));
 }

 public function getCancelUrl()
 {
  return new Url('mydata.display_table_controller_display');
 }
 public function getDescription()
 {
  return t('Only do this if you are sure!');
 }

 /**
  * {@inheritdoc}
  */
 public function getConfirmText()
 {
  return t('Delete it!');
 }

 /**
  * {@inheritdoc}
  */
 public function getCancelText()
 {
  return t('Cancel');
 }

 /**
  * {@inheritdoc}
  */
 public function buildForm(array $form, FormStateInterface $form_state, $cid = null)
 {

  $this->id = $cid;
  return parent::buildForm($form, $form_state);
 }

 /**
  * {@inheritdoc}
  */
 public function validateForm(array &$form, FormStateInterface $form_state)
 {
  parent::validateForm($form, $form_state);
 }

 /**
  * {@inheritdoc}
  */
 public function submitForm(array &$form, FormStateInterface $form_state)
 {

  //print_r($form_state);die;
  $query = \Drupal::database();

  $query->delete('mydata')

   ->condition('id', $this->id)
   ->execute();

  \Drupal::messenger()->addMessage("Employee deleted");

  $form_state->setRedirect('mydata.display_table_controller_display');
 }

}
