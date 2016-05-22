<?php
/**
 * @file
 * Contains \Drupal\bubble_sort\Controller\BubbleSortController
 */

namespace Drupal\bubble_sort\Controller;

use Drupal\Core\Controller\ControllerBase;


class BubbleSortController extends ControllerBase {

	static function shuffle() {

		$numberArray = array();
		for ($i = 0; $i < 10; $i++) {
			$randomNumber = rand(0, 100);
			array_push($numberArray, $randomNumber);
		}
		$sortedArray = $numberArray;
		rsort($sortedArray);

		$_SESSION['bubble_sort']['n'] = 0;
		$_SESSION['bubble_sort']['sorting'] = 0;
		$_SESSION['bubble_sort']['numberArray'] = $numberArray;
		$_SESSION['bubble_sort']['sortedArray'] = $sortedArray;

	}

	static function step() {

		$numberArray = $_SESSION['bubble_sort']['numberArray'];
		$n = $_SESSION['bubble_sort']['n'];

		if($n > 8) {
			$n = 0;
		}

		$first = $numberArray[$n];
		$second = $numberArray[$n + 1];

		if($first < $second) {
			$numberArray[$n] = $second;
			$numberArray[$n + 1] = $first;
		}

		$n++;

		$_SESSION['bubble_sort']['numberArray'] = $numberArray;
		$_SESSION['bubble_sort']['n'] = $n;
		$_SESSION['bubble_sort']['sorting'] = 1;

	}

	public function content() {

		if (!isset($_SESSION['bubble_sort']['numberArray'])) {
			drupal_set_message('session numberarray was not set');
			$this->shuffle();
		}

		$numberArray = $_SESSION['bubble_sort']['numberArray'];
		$n = $_SESSION['bubble_sort']['n'];
		$sorting = $_SESSION['bubble_sort']['sorting'];
		$sortedArray = $_SESSION['bubble_sort']['sortedArray'];

		// serialize arrays
		$numberArray = implode(',', $numberArray);
		$sortedArray = implode(',', $sortedArray);

		$form = \Drupal::formBuilder()->getForm('Drupal\bubble_sort\Form\BubbleSortForm');

    	return array(
	    	array(
	    		'#theme' => 'bubble_sort',
	    		'#n' => $n,
	    		'#numberArray' => $numberArray,
	    		'#sorting' => $sorting,
	    		'#sortedArray' => $sortedArray,
	    	),
			$form,
    	);

	}
}