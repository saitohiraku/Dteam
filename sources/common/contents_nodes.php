<?php
/*!
@file contents_node.php
@brief 共有するノード
@copyright Copyright (c) 2024 Yamanoi Yasushi.
*/

////////////////////////////////////


//--------------------------------------------------------------------------------------
///	ユーザーヘッダノード
//--------------------------------------------------------------------------------------
class cheader extends cnode
{
	//--------------------------------------------------------------------------------------
	/*!
	@brief	コンストラクタ
	*/
	//--------------------------------------------------------------------------------------
	public function __construct()
	{
		//親クラスのコンストラクタを呼ぶ
		parent::__construct();
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	構築時の処理(継承して使用)
	@return	なし
	*/
	//--------------------------------------------------------------------------------------
	public function create()
	{
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief  表示(継承して使用)
	@return なし
	*/
	//--------------------------------------------------------------------------------------
	public function display()
	{
		$css_files = [
			'index.php' => 'css/index.css',
			'gachaSelect.php' => 'css/gachaSelect.css',
			'gachaPull.php' => 'css/gachaPull.css',
			'gachaResult.php' => 'css/gachaResult.css',
			'stampCard.php' => 'css/stampCard.css',
			'stampCardPass.php' => 'css/stampCardPass.css',
			'stampCardGetPoint.php' => 'css/stampCardGetPoint.css',
			'sightseeing.php' => 'css/sightseeing.css',
			'sightseeingDetail.php' => 'css/sightseeingDetail.css',
			'overview.php' => 'css/overview.css',
			'mypage.php' => 'css/mypage.css',
			'login.php' => 'css/login.css',
			'signin.php' => 'css/login.css',
			'termsOfService.php' => 'css/termsOfService.css',
			'policy.php' => 'css/policy.css',
			'QAF.php' => 'css/QAF.css',
			'userInfoEdit.php' => 'css/userInfoEdit.css',
			'BenefitPurchase.php' => 'css/BenefitPurchase.css'
		];

		$page_name = basename($_SERVER['PHP_SELF']);
		$page_specific_css = "";

		if (isset($css_files[$page_name])) {
			$page_specific_css = '<link rel="stylesheet" type="text/css" href="' . $css_files[$page_name] . '">';
		}

		$echo_str = <<< END_BLOCK

		<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/header.css">
		$page_specific_css
		</head>
		<body>
		<!-- 全体コンテナ　-->
			<header class="header">
				<div class="navtext-container">
					<div class="navtext"><a href="./index.php">旅ガチャ</a></div>
				</div>
				<input type="checkbox" class="menu-btn" id="menu-btn">
				<label for="menu-btn" class="menu-icon"><span class="navicon"></span></label>
				<ul class="menu">
					<li class="top"><a href="./index.php">ホーム</a></li>
					<li class="top"><a href="./gachaSelect.php">ガチャ</a></li>
					<li class="top"><a href="./stampCard.php">スタンプカード</a></li>
					<li class="top"><a href="./sightseeing.php">観光地一覧</a></li>
					<li class="top"><a href="./mypage.php">マイページ</a></li>
					<li class="top"><a href="./login.php">ログイン</a></li>
					<li class="top"><a href="./signin.php">ログアウト</a></li>
				</ul>
			</header>
END_BLOCK;
		echo $echo_str;
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	デストラクタ
	*/
	//--------------------------------------------------------------------------------------
	public function __destruct()
	{
		//親クラスのデストラクタを呼ぶ
		parent::__destruct();
	}
}

//--------------------------------------------------------------------------------------
///	スタンプノード
//--------------------------------------------------------------------------------------
class stampcheader extends cnode
{
	//--------------------------------------------------------------------------------------
	/*!
    @brief    コンストラクタ
    */
	//--------------------------------------------------------------------------------------
	public function __construct()
	{
		//親クラスのコンストラクタを呼ぶ
		parent::__construct();
	}
	//--------------------------------------------------------------------------------------
	/*!
    @brief    構築時の処理(継承して使用)
    @return    なし
    */
	//--------------------------------------------------------------------------------------
	public function create()
	{
	}
	//--------------------------------------------------------------------------------------
	/*!
    @brief  表示(継承して使用)
    @return なし
    */
	//--------------------------------------------------------------------------------------
	public function display()
	{
		$echo_str = <<< END_BLOCK
		
        <head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/header.css">
		<link rel="stylesheet" type="text/css" href="css/stampCard.css">
		</head>
		<body>
		<!-- 全体コンテナ　-->
			<header class="header">
				<div class="navtext-container">
					<div class="navtext"><a href="./index.php">旅ガチャ</a></div>
				</div>
				<input type="checkbox" class="menu-btn" id="menu-btn">
				<label for="menu-btn" class="menu-icon"><span class="navicon"></span></label>
				<ul class="menu">
					<li class="top"><a href="./index.php">ホーム</a></li>
					<li class="top"><a href="./gachaSelect.php">ガチャ</a></li>
					<li class="top"><a href="./stampCard.php">スタンプカード</a></li>
					<li class="top"><a href="./sightseeing.php">観光地一覧</a></li>
					<li class="top"><a href="./mypage.php">マイページ</a></li>
					<li class="top"><a href="./login.php">ログイン</a></li>
					<li class="top"><a href="./signin.php">ログアウト</a></li>
				</ul>
			</header>
END_BLOCK;
		echo $echo_str;
	}
	//--------------------------------------------------------------------------------------
	/*!
    @brief    デストラクタ
    */
	//--------------------------------------------------------------------------------------
	public function __destruct()
	{
		//親クラスのデストラクタを呼ぶ
		parent::__destruct();
	}
}

//--------------------------------------------------------------------------------------
///	管理者ヘッダノード
//--------------------------------------------------------------------------------------
class admin_cheader extends cnode
{
	//--------------------------------------------------------------------------------------
	/*!
    @brief    コンストラクタ
    */
	//--------------------------------------------------------------------------------------
	public function __construct()
	{
		//親クラスのコンストラクタを呼ぶ
		parent::__construct();
	}
	//--------------------------------------------------------------------------------------
	/*!
    @brief    構築時の処理(継承して使用)
    @return    なし
    */
	//--------------------------------------------------------------------------------------
	public function create()
	{
	}
	//--------------------------------------------------------------------------------------
	/*!
    @brief  表示(継承して使用)
    @return なし
    */
	//--------------------------------------------------------------------------------------
	public function display()
	{
		$css_files = [
			'admin.php' => '../css/admin.css',
			'adminDetail.php' => '../css/adminDetail.css'
		];

		$page_name = basename($_SERVER['PHP_SELF']);
		$page_specific_css = "";

		if (isset($css_files[$page_name])) {
			$page_specific_css = '<link rel="stylesheet" type="text/css" href="' . $css_files[$page_name] . '">';
		}

		$js_files = [
			'adminDetail.php' => '../js/deleteConfirm.js'
		];

		$page_specific_js = "";

		if (isset($js_files[$page_name])) {
			$page_specific_js = '<script type="text/javascript" src="' . $js_files[$page_name] . '"></script>';
		}

		// ページ名に基づいてselectedクラスを追加
		$selected_class = [
			'admin.php' => '',
			'adminDetail.php' => '',
			'userManagement.php' => '',
			'touristManagement.php' => '',
			'stampManagement.php' => '',
			'admin_logout.php' => ''
		];

		if (isset($selected_class[$page_name])) {
			$selected_class[$page_name] = 'selected';
		}

		$echo_str = <<< END_BLOCK
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../css/adminStyle.css">
        $page_specific_css
        $page_specific_js
    </head>
    <body id="container">
    <aside class="sidebar">
        <h1>管理画面</h1>
        <ul>
            <li class="borderBottom {$selected_class['admin.php']} {$selected_class['adminDetail.php']}"><a href="admin.php">管理者管理</a></li>
            <li class="borderBottom {$selected_class['userManagement.php']}"><a href="userManagement.php">ユーザー管理</a></li>
            <li class="borderBottom {$selected_class['touristManagement.php']}"><a href="touristManagement.php">観光地管理</a></li>
            <li class="borderBottom {$selected_class['stampManagement.php']}"><a href="stampManagement.php">スタンプ管理</a></li>
            <li class="{$selected_class['admin_logout.php']}"><a href="admin_logout.php">ログアウト</a></li>
        </ul>
END_BLOCK;

		echo $echo_str;
	}


	//--------------------------------------------------------------------------------------
	/*!
    @brief    デストラクタ
    */
	//--------------------------------------------------------------------------------------
	public function __destruct()
	{
		//親クラスのデストラクタを呼ぶ
		parent::__destruct();
	}
}

//--------------------------------------------------------------------------------------
///	サインイン・ログインノード
//--------------------------------------------------------------------------------------
class admin_signin_login extends cnode
{
	//--------------------------------------------------------------------------------------
	/*!
    @brief    コンストラクタ
    */
	//--------------------------------------------------------------------------------------
	public function __construct()
	{
		//親クラスのコンストラクタを呼ぶ
		parent::__construct();
	}
	//--------------------------------------------------------------------------------------
	/*!
    @brief    構築時の処理(継承して使用)
    @return    なし
    */
	//--------------------------------------------------------------------------------------
	public function create()
	{
	}
	//--------------------------------------------------------------------------------------
	/*!
    @brief  表示(継承して使用)
    @return なし
    */
	//--------------------------------------------------------------------------------------
	public function display()
	{
		$echo_str = <<< END_BLOCK
		
        <head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>ログイン画面</title>
		<style>
			body {
				display: flex;
				justify-content: center;
				align-items: center;
				height: 100vh;
				margin: 0;
				background-color: #e0f7fa;
				font-family: Arial, sans-serif;
			}

			.login-container {
				background-color: #ffffff;
				padding: 20px;
				border-radius: 8px;
				box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
				text-align: center;
				width: 90%;
				max-width: 400px;
			}

			.login-container h2 {
				color: #0277bd;
				margin-bottom: 20px;
			}

			.input-group {
				margin-bottom: 15px;
				text-align: left;
			}

			.input-group label {
				display: block;
				margin-bottom: 5px;
				color: #01579b;
			}

			.input-group input {
				width: 100%;
				padding: 10px;
				border: 1px solid #b0bec5;
				border-radius: 4px;
				box-sizing: border-box;
			}

			button {
				width: 100%;
				padding: 10px;
				background-color: #0288d1;
				border: none;
				border-radius: 4px;
				color: white;
				font-size: 16px;
				cursor: pointer;
				box-sizing: border-box;
			}

			button:hover {
				background-color: #0277bd;
			}

			.error-message {
				color: red;
				margin-bottom: 15px;
			}

			.to-signin {
				margin-top: 20px;
			}

			.to-signin a {
				color: #0288d1;
				text-decoration: none;
			}

			.to-signin a:hover {
				text-decoration: underline;
			}
		</style>
		</head>
		<body id="contaner">
END_BLOCK;
		echo $echo_str;
	}
	//--------------------------------------------------------------------------------------
	/*!
    @brief    デストラクタ
    */
	//--------------------------------------------------------------------------------------
	public function __destruct()
	{
		//親クラスのデストラクタを呼ぶ
		parent::__destruct();
	}
}

//--------------------------------------------------------------------------------------
///	フッターノード
//--------------------------------------------------------------------------------------
class cfooter extends cnode
{
	//--------------------------------------------------------------------------------------
	/*!
	@brief	コンストラクタ
	*/
	//--------------------------------------------------------------------------------------
	public function __construct()
	{
		//親クラスのコンストラクタを呼ぶ
		parent::__construct();
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	構築時の処理(継承して使用)
	@return	なし
	*/
	//--------------------------------------------------------------------------------------
	public function create()
	{
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief  表示(継承して使用)
	@return なし
	*/
	//--------------------------------------------------------------------------------------
	public function display()
	{
		$echo_str = <<< END_BLOCK

		<footer class="py-3 my-4 border-dark border-top">
			<p class="text-center text-body-secondary">&copy; 2024 PHPBase2</p>
		</footer>
		<!-- /全体コンテナ　-->
		</body>
		</html>
END_BLOCK;
		echo $echo_str;
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	デストラクタ
	*/
	//--------------------------------------------------------------------------------------
	public function __destruct()
	{
		//親クラスのデストラクタを呼ぶ
		parent::__destruct();
	}
}
