<?php
	class test {
		var $str = "Testing Var<br />";
		function TestA() {
			echo "Test A function online<br />";
		}
	}
	
	class testb extends test {
		function TestC() {
			echo "Test B function online<br />";
			echo $this->str;
		}
	}
	
	$test->TestA();
	echo "<br /><hr /><br />";
	$test->test2 = new testb();
	$test->test2->TestC();
?>