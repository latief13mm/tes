<?php
/**
 * @file
 * Contains \Drupal\products\Form\ProductForm.
 */
namespace Drupal\products\Form;


use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Connection;
use Drupal\Core\Link;
use Drupal\Core\Url;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\Core\Render\Element;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Ajax\ReplaceCommand;

class ProductForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'product_form';
  }
  public $cid;
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $cid = NULL) {
    $this->iid = $cid;
    $form['product_name'] = array(
      '#type' => 'textfield',
      '#title' => t('Iteam Name:'),
      '#required' => TRUE,
	  '#default_value' => (isset($record['iteam_name']) && $cid) ? $record['product_name']:'',
    );

    $form['product_detail'] = array(
      '#type' => 'textfield',
      '#title' => t('Iteam Detail:'),
      '#required' => TRUE,
	  '#default_value' => (isset($record['iteam_detail']) && $cid) ? $record['product_detail']:'',
    );

    $form['product_address'] = array (
      '#type' => 'textfield',
      '#title' => t('Address:'),
	  '#default_value' => (isset($record['iteam_address']) && $cid) ? $record['product_address']:'',
    );

    $form['product_age'] = array (
      '#type' => 'textfield',
      '#title' => t('Purchaged on'),
      '#required' => TRUE,
	  '#default_value' => (isset($record['iteam_age']) && $cid) ? $record['product_age']:'',
    );

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
    );
    $form['actions']['#type'] = 'actions';
    $form['actions']['update'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Update'),
      '#button_type' => 'primary',
    );
    return $form;
  }
    
  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
	  
	$connection = \Drupal :: database();
	if($this->iid){
		
		$query = $connection->update('products');
		$query->fields([
			'product_name'=>$form_state->getValue('product_name'),
			'product_detail'=>$form_state->getValue('product_detail'),
			'product_address'=>$form_state->getValue('product_address'),
			'product_age'=>$form_state->getValue('product_age'),
		]);
		$query->condition('pid', $this->iid);
		$query->execute();   
		drupal_set_message("succesfully updated");
		
	}
	else{
		$query = $connection->insert('products');
		$query->fields([
			'pid'=>'',
			'product_name'=>$form_state->getValue('product_name'),
			'product_detail'=>$form_state->getValue('product_detail'),
			'product_address'=>$form_state->getValue('product_address'),
			'product_age'=>$form_state->getValue('product_age'),
		]);
		$query->execute();  
        drupal_set_message("One row succesfully inserted");
	}

   }
}
