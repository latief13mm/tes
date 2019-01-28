<?php
/**
 * @file
 * Contains \Drupal\resume\Form\ResumeForm.
 */
namespace Drupal\resume\Form;


use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Connection;
use Drupal\Core\Link;
use Drupal\Core\Url;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\Core\Render\Element;

class ResumeForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'resume_form';
  }
  public $cid;
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $cid = NULL) {
	$this->iid = $cid;
	$connection = \Drupal :: database();
	$query = $connection->select('iteams','m')
            ->condition('iid', $cid)
            ->fields('m');
			$record = $query->execute()->fetchAssoc();
			

    $form['iteam_name'] = array(
      '#type' => 'textfield',
      '#title' => t('Iteam Name:'),
      '#required' => TRUE,
	  '#default_value' => (isset($record['iteam_name']) && $cid) ? $record['iteam_name']:'',
    );

    $form['iteam_detail'] = array(
      '#type' => 'textfield',
      '#title' => t('Iteam Detail:'),
      '#required' => TRUE,
	  '#default_value' => (isset($record['iteam_detail']) && $cid) ? $record['iteam_detail']:'',
    );

    $form['iteam_address'] = array (
      '#type' => 'textfield',
      '#title' => t('Address:'),
	  '#default_value' => (isset($record['iteam_address']) && $cid) ? $record['iteam_address']:'',
    );

    $form['iteam_age'] = array (
      '#type' => 'textfield',
      '#title' => t('Purchaged on'),
      '#required' => TRUE,
	  '#default_value' => (isset($record['iteam_age']) && $cid) ? $record['iteam_age']:'',
    );

    $form['iteam_interest'] = array (
      '#type' => 'select',
      '#title' => ('Interested'),
      '#options' => array(
        '0' => t('No'),
        '1' => t('Yes'),
        '2' => t('Cancel'),
      ),
	  '#default_value' => (isset($record['iteam_interest']) && $cid) ? $record['iteam_interest']:'',
    );

    $form['iteam_offer'] = array (
      '#type' => 'select',
      '#title' => ('Offer'),
      '#options' => array(
        '0' => t('No'),
        '1' => t('Yes'),
		'2' => t('Cancel'),
      ),
	  '#default_value' => (isset($record['iteam_offer']) && $cid) ? $record['iteam_offer']:'',
    );

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
    );
    $form['actions']['#type'] = 'actions';
    $form['actions']['interest'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Interest'),
      '#button_type' => 'primary',
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
    public function validateForm(array &$form, FormStateInterface $form_state) {

      if (strlen($form_state->getValue('iteam_address')) < 10) {
        $form_state->setErrorByName('iteam_address', $this->t('Mobile number is too short.'));
      }

    }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
	  
/* 	  $op = $form_state->getValue('op');
	  switch($op){
		  case 'Interest':{
			foreach ($form_state->getValues() as $key => $value) {
			  drupal_set_message($key . ': ' . $value);
			}	  
		  }
		  case 'Save':{
			foreach ($form_state->getValues() as $key => $value) {
			  drupal_set_message($key . ': ' . $value);
			}	  
		  }
	  } */

	$connection = \Drupal :: database();
	if($this->iid){
		
		$query = $connection->update('iteams');
		$query->fields([
			'iteam_name'=>$form_state->getValue('iteam_name'),
			'iteam_detail'=>$form_state->getValue('iteam_detail'),
			'iteam_address'=>$form_state->getValue('iteam_address'),
			'iteam_age'=>$form_state->getValue('iteam_age'),
			'iteam_interest'=>$form_state->getValue('iteam_interest'),
			'iteam_offer'=>$form_state->getValue('iteam_offer'),
		]);
		$query->condition('iid', $this->iid);
		$query->execute();   
		drupal_set_message("succesfully updated");
		
	}
	else{
		$query = $connection->insert('iteams');
		$query->fields([
			'iteam_name'=>$form_state->getValue('iteam_name'),
			'iteam_name'=>$form_state->getValue('iteam_name'),
			'iteam_detail'=>$form_state->getValue('iteam_detail'),
			'iteam_address'=>$form_state->getValue('iteam_address'),
			'iteam_age'=>$form_state->getValue('iteam_age'),
			'iteam_interest'=>$form_state->getValue('iteam_interest'),
			'iteam_offer'=>$form_state->getValue('iteam_offer'),
		]);
		$query->execute();   
	}
   // drupal_set_message($this->t('@can_name ,Your application is being submitted!', array('@can_name' => $form_state->getValue('candidate_name'))));

    

   }
   
    public function showdata() {
	drupal_set_message("I am here".$cid);

  }
}