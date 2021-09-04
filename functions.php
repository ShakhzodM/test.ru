<?php
	function createInputWithText($text, $nameInput, $resultId){
		$result = "<form>
					$text
					<input type=\"text\" name=\"$nameInput\">
					<input type=\"submit\">
				   </form>
				   <div id=\"$resultId\">
				   </div>
				";
		return $result;
	}

?>