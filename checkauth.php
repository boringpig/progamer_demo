 <?php
	function authaccess($w_auth){
		session_start();
		if (isset($_SESSION['login'])){
			$m_auth = (int)$_SESSION['auth'];
			(int)$w_auth;
			$allow = $m_auth >= $w_auth;
			if (!$allow) {
				header("Location:/");
				exit;
				//header("Location:/");
			}
		} else {
			header("Location:/account/");
		}
	}

	function isLogin(){
		session_start();
		if (isset($_SESSION['login'])) {
			if (!$_SESSION['auth'] >= 2) {
				header("Location:/ ");
				exit;
			}
		}
	}
?>