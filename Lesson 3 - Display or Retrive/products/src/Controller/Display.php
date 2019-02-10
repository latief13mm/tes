<?php
/**
 * @file
 * Contains \Drupal\resume\Controller\Display.
 */

namespace Drupal\products\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Link;
use Drupal\Core\Url;
use Drupal\Component\Serialization\Json;

/**
 * Class Display.
 *
 * @package Drupal\resume\Controller
 */
class Display extends ControllerBase {

  /**
   * showdata.
   *
   * @return string
   *   Return Table format data.
   */
  public function showdata() {
      $result = \Drupal::database()->select('products', 'n')
            ->fields('n', array('pid', 'product_name', 'product_detail'))
            ->execute()->fetchAllAssoc('pid');
      // Create the row element.
    $rows = array();
    foreach ($result as $row => $content) {
		$Delete = Url::fromUserInput('/products/form/'.$content->pid.'/delete');
		$Edit = Url::fromUserInput('/products/form/'.$content->pid.'/edit');
      $rows[] = array(
        'data' => array(
			$content->pid, 
			'content'=>$content->product_name,
			'Detail'=> $content->product_detail, 
			 \Drupal::l('Delete',$Delete), 
			 \Drupal::l('Edit',$Edit)
        ));
    }
    // Create the header.
    $header = array('SL no', 'Name', 'Detail', 'Delete', 'Edit');
    $output = array(
        '#theme' => 'table',    // Here you can write #type also instead of #theme.
        '#header' => $header,
        '#rows' => $rows,
        '#attached' => [
            'library' =>  [
                'products/products.products'  //First is controller name "resume/"
            ],
        ],
    );  
    return $output;
  }
}
