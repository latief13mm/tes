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
    $form['barang_nama'] = array(
      '#type' => 'textfield',
      '#title' => t('Iteam Nama:'),
      '#required' => TRUE,
	  '#default_value' => (isset($record['iteam_nama']) && $cid) ? $record['barang_nama']:'',
    );

    $form['barang_harga'] = array(
      '#type' => 'textfield',
      '#title' => t('Iteam Harga:'),
      '#required' => TRUE,
	  '#default_value' => (isset($record['iteam_harga']) && $cid) ? $record['barang_harga']:'',
    );

    $form['barang_gambar'] = array (
      '#type' => 'textfield',
      '#title' => t('Iteam Gambar:'),
	  '#default_value' => (isset($record['iteam_gambar']) && $cid) ? $record['barang_gambar']:'',
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
		
		$query = $connection->update('barangs');
		$query->fields([
			'barang_name'=>$form_state->getValue('barang_nama'),
			'barang_harga'=>$form_state->getValue('barang_harga'),
			'barang_gambar'=>$form_state->getValue('barang_gambar'),
		]);
		$query->condition('pid', $this->iid);
		$query->execute();   
		drupal_set_message("succesfully updated");
		
	}
	else{
		$query = $connection->insert('barangs');
		$query->fields([
			'pid'=>'',
			'barang_nama'=>$form_state->getValue('barang_nama'),
      'barang_harga'=>$form_state->getValue('barang_harga'),
			'barang_gambar'=>$form_state->getValue('barang_gambar'),
		]);
		$query->execute();  
        drupal_set_message("One row succesfully inserted");
	}

   }
}
