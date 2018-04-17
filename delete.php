<?php

if (!empty($_POST)) 
{
	unlink($_POST['submit']);
	header('location: form.php');
}
