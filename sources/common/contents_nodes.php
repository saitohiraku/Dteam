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
        $echo_str = <<< END_BLOCK
		
        <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../css/admin.css">
        </head>
        <body id="contaner">
		<aside class="sidebar">
			<h1>管理画面</h1>
			<ul>
				<li class="borderBottom"><a href="">管理者管理</a></li>
				<li class="borderBottom"><a href="">ユーザー管理</a></li>
				<li class="borderBottom"><a href="">観光地管理</a></li>
				<li class="borderBottom"><a href="">スタンプ管理</a></li>
				<li><a href="">ログアウト</a></li>
			</ul>
    </aside>
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
?>
