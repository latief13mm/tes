<?php
/**
 * @file
 * Contains \Drupal\resume\Controller\Display.
 */

namespace Drupal\resume\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Link;
use Drupal\Core\Url;

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
	  

  
	$result = \Drupal::database()->select('iteams', 'n')
            ->fields('n', array('iid', 'iteam_name', 'iteam_detail'))
            ->execute()->fetchAllAssoc('iid');
// Create the row element.
    $rows = array();
    foreach ($result as $row => $content) {
		$Delete = Url::fromUserInput('/resume/myform/'.$content->iid.'/delete');
		$Edit = Url::fromUserInput('/resume/myform/'.$content->iid.'/edit');
      $rows[] = array(
        'data' => array(
			$content->iid, 
			'content'=>$content->iteam_name,
			'Detail'=> $content->iteam_detail, 
			 \Drupal::l('Delete',$Delete), 
			 \Drupal::l('Edit',$Edit)));
    }
// Create the header.
    $header = array('iid', 'iteam_name', 'iteam detail', 'Delete', 'Edit');
    $output = array(
      '#theme' => 'table',    // Here you can write #type also instead of #theme.
      '#header' => $header,
      '#rows' => $rows
    );
    return $output;
  }
}
