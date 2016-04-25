<?php
  
if(!isset($_SESSION['LOGIN_username'])){
	exit("<script>location.href='./';</script>");
}