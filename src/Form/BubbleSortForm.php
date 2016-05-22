<?php 

/**
 * @file
 * Contains \Drupal\bubble_sort\Form\BubbleSortForm.
 */

namespace Drupal\bubble_sort\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class BubbleSortForm extends FormBase {

	static function shuffle() {
		$controller = new \Drupal\bubble_sort\Controller\BubbleSortController();
		$controller->shuffle();
	}

	static function step() {
		$controller = new \Drupal\bubble_sort\Controller\BubbleSortController();
		$controller->step();
	}

  public function getFormId() {
    return 'bubble_sort_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['actions'] = [
      '#type' => 'actions',
    ];

    $form['actions']['shuffle'] = [
      '#type' => 'submit',
      '#value' => $this->t('Shuffle'),
      '#submit' =>array('::shuffle'),
    ];

    $form['actions']['step'] = [
      '#type' => 'submit',
      '#value' => $this->t('Step'),
      '#submit' =>array('::step'),
    ];

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
  }

}