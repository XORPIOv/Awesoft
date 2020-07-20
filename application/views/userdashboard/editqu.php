<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->helper('url');

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title> Dashboard</title>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>style.css">
</head>

<body>
	<!--div is a container-->

	<div class="loginbox">
		<h1>Answers</h1>

		<form id="addquform" name="editqu" action="<?php echo base_url(); ?>index.php/welcome/doeditqu" method="post">
			
			
			
			<label for="question">Question</label><br>
		
			<input type="hidden" name="qid" value="<?php echo $quinfo->qid ?>">
			<input type="text" id="qid" name="question" value="<?php echo $quinfo->question ?>"><br>
			<input type="text" id="qid" name="answer" value="" required><br>

  <ul class="userlist">
  <?php foreach ($answers as $answer) {
  echo "<a ><li>$answer->answer , By $answer->Username</li></a>";
  
}
?>

</ul>

	
  <input type="submit" value="Add answer">
		</form>
		<form action="http//localhost:3306/Awesoft">
		<input type="submit" value="logout" >
</form>

	</div>
</body>

</html>