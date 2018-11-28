<?php
	class SliderItem {
		public $imgPath = '';
		public $imgAlt = '';
    public $captionText = '';
    public $buttonText = '';

		public function __construct(array $properties = NULL) {
			if (!is_null($properties) && !empty($properties)) {
				foreach ($properties as $property => $value) {
					$this->$property = $value;
				}
			}
		}
	}
?>
