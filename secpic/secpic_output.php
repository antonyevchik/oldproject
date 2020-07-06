<img src="secpic.php" alt="" />
<form action="secpic_output.php" method="post">
<input type="text" name="secpic" />
<input type="submit" value="send" />
</form>
<?php
session_start();
//include('secpic.php');
echo "session: ". $_SESSION['secpic'];
//if (empty($_SESSION['secpic'])) {echo "Ok";}


?>