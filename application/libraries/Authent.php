<?php

class Authent {

  function checkLogin()
  {
  	//session_start();
    if( NULL == $_SESSION['username']) {
			redirect('/users/login');
	}

  }

  function isSuperAdmin()
  {
	if(isset($_SESSION['username'])) {
		if($_SESSION['role'] != '1') {
			return false;
		} else {
			return true;
		}
	}

  }



}
