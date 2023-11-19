<html>
<body>
<form name="update" method="post" >
    <button name = "update" type="reset"> Update charts </button>
</form>
</body>
</html>

<?php
if (isset($_POST['update']))
{
exec("/usr/bin/python /var/www/html/mysql.py $input_val");
}
?>
