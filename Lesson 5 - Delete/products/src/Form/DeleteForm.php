<?php
namespace Drupal\products\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfirmFormBase;
use Drupal\Core\Url;
use Drupal\Core\Render\Element;

class DeleteForm extends ConfirmFormBase {
	public function getFormId() {
		return 'delete_form';
	}
	public $cid;
    public function getQuestion() { 
		return t('Do you want to delete %cid?', array('%cid' => $this->cid));
	}
	public function getCancelUrl() {
		return new Url('resume.iteams');
	}
	public function getDescription() {
		return t('Only do this if you are sure!');
	}
/**
* {@inheritdoc}
*/
	public function getConfirmText() {
		return t('Delete it!');
	}
/**
* {@inheritdoc}
*/
	public function getCancelText() {
		return t('Cancel');
	}
/**
* {@inheritdoc}
*/
	public function buildForm(array $form, FormStateInterface $form_state, $cid = NULL) {
		$this->id = $cid;
		return parent::buildForm($form, $form_state);
	}
/**
* {@inheritdoc}
*/
	public function validateForm(array &$form, FormStateInterface $form_state) {
		parent::validateForm($form, $form_state);
	}
/**
* {@inheritdoc}
*/
	public function submitForm(array &$form, FormStateInterface $form_state) {

		$query = \Drupal::database();
		//echo $this->id; die;
		$query->delete('barangs')
			->condition('pid',$this->id)
			->execute();
		drupal_set_message("succesfully deleted");
		$form_state->setRedirect('products.products');
	}

}