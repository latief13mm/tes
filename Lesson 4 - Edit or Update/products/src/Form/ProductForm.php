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
    $this->pid = $cid;
    $connection = \Drupal :: database();
	$query = $connection->select('barangs','m')
            ->condition('pid', $cid)
            ->fields('m');
			$record = $query->execute()->fetchAssoc();
      
    $form['barang_nama'] = array(
      '#type' => 'textfield',
      '#title' => t('Iteam Nama:'),
      '#required' => TRUE,
	  '#default_value' => (isset($record['barang_nama']) && $cid) ? $record['barang_name']:'',
    );

    $form['barang_harga'] = array(
      '#type' => 'textfield',
      '#title' => t('Iteam Harga:'),
      '#required' => TRUE,
	  '#default_value' => (isset($record['barang_harga']) && $cid) ? $record['barang_harga']:'',
    );

    $form['barang_gambar'] = array (
      '#type' => 'textfield',
      '#title' => t('Iteam Gambar:'),
	  '#default_value' => (isset($record['barang_gambar']) && $cid) ? $record['barang_gambar']:'',
    );

    if(!$cid){
        $form['actions']['#type'] = 'actions';
        $form['actions']['submit'] = array(
          '#type' => 'submit',
          '#value' => $this->t('Save'),
          '#button_type' => 'primary',
        );
    }
    else{
        $form['actions']['#type'] = 'actions';
        $form['actions']['update'] = array(
          '#type' => 'submit',
          '#value' => $this->t('Update'),
          '#button_type' => 'primary',
        );
    }    
    return $form;
  }
    
  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
	  
	$connection = \Drupal :: database();
	if($this->pid){
		
		$query = $connection->update('barangs');
		$query->fields([
			'barang_nama'=>$form_state->getValue('barang_nama'),
			'barang_harga'=>$form_state->getValue('barang_harga'),
			'barang_gambar'=>$form_state->getValue('barang_gambar'),
		]);
		$query->condition('pid', $this->pid);
		$query->execute();   
		drupal_set_message("succesfully updated");
		
	}
	else{
		$query = $connection->insert('barangs');
		$query->fields([
			'pid'=>1,
      'barang_nama'=>$form_state->getValue('barang_nama'),
			'barang_harga'=>$form_state->getValue('barang_harga'),
			'barang_gambar'=>$form_state->getValue('barang_gambar'),
		]);
		$query->execute();  
        drupal_set_message("One row succesfully inserted");
	}

   }
}
