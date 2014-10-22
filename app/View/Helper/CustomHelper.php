<?php
App::uses('AppHelper', 'View/Helper');

class CustomHelper extends AppHelper {

	/**
	 * Show validation errors on top form
	 * 
	 * @param mixed $errors Error. Array or string
	 * @param string $class Class of container contain errors
	 */
	public static function validationSummary($errors, $class = "") {
		$html = "";

		if ($errors && !empty($errors)) {
			$html .= "<div class=\"$class\">";
			
			if (is_array($errors)) {
				$_errors = Set::flatten($errors);

				foreach ($_errors as $error) {
					$html .= "<p>$error</p>";
				}
			} else {
				$html .= "<p>$errors</p>";
			}
			
			$html .= "</div>";
		}

		return $html;
	}

}
