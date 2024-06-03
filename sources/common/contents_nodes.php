<?php
/*!
@file contents_node.php
@brief 共有するノード
@copyright Copyright (c) 2024 Yamanoi Yasushi.
*/

////////////////////////////////////


//--------------------------------------------------------------------------------------
///	ヘッダノード
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
		$page_specific_css = "";
        if (basename($_SERVER['PHP_SELF']) == 'index.php') {
            $page_specific_css = '<link rel="stylesheet" type="text/css" href="css/index.css">';
        }
		else if (basename($_SERVER['PHP_SELF']) == 'gachaSelect.php') {
            $page_specific_css = '<link rel="stylesheet" type="text/css" href="css/gachaSelect.css">';
        }
		else if (basename($_SERVER['PHP_SELF']) == 'gachaPull.php') {
            $page_specific_css = '<link rel="stylesheet" type="text/css" href="css/gachaPull.css">';
        }
		else if (basename($_SERVER['PHP_SELF']) == 'gachaResult.php') {
            $page_specific_css = '<link rel="stylesheet" type="text/css" href="css/gachaResult.css">';
        }
		else if (basename($_SERVER['PHP_SELF']) == 'stampCard.php') {
            $page_specific_css = '<link rel="stylesheet" type="text/css" href="css/stampCard.css">';
        }
		else if (basename($_SERVER['PHP_SELF']) == 'stampCardPass.php') {
            $page_specific_css = '<link rel="stylesheet" type="text/css" href="css/stampCardPass.css">';
        }
		else if (basename($_SERVER['PHP_SELF']) == 'stampCardGetPoint.php') {
            $page_specific_css = '<link rel="stylesheet" type="text/css" href="css/stampCardGetPoint.css">';
        }
		else if (basename($_SERVER['PHP_SELF']) == 'sightseeing.php') {
            $page_specific_css = '<link rel="stylesheet" type="text/css" href="css/sightseeing.css">';
        }
		else if (basename($_SERVER['PHP_SELF']) == 'sightseeingDetail.php') {
            $page_specific_css = '<link rel="stylesheet" type="text/css" href="css/sightseeingDetail.css">';
        }
		else if (basename($_SERVER['PHP_SELF']) == 'overview.php') {
            $page_specific_css = '<link rel="stylesheet" type="text/css" href="css/overview.css">';
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
					<li class="top"><a href="./index.php">マイページ</a></li>
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
