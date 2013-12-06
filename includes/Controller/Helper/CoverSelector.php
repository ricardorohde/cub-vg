<?php
	/**
	* 
	*/
	class Helper_CoverSelector
	{
		public function __invoke (array &$images)
		{
			foreach($images as $image) {

				if($image["cover"] == 1)
					return $image;
			}

			return reset($images);
		}
	}
?>