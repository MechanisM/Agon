<?php
	class template{
		public $template;
		public function select($name) {
			if(_c("com.template.".$name)) { # We need to load the template from the database into the vars
				$this->template = _c("com.template.".$name);
			} else {
				echo "Warning. Template undefined";
			}
		}
		function replace($var, $content) {
	      $this->template = str_replace("#$var#", $content, $this->template);
	   }
	   function publish() {
	     		eval("?>".$this->template."<?");
	   }
	}
	$t = new template();
?>