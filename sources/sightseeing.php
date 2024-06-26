<?php
/*!
@file hinagata.php
@brief ページ作成の雛形ファイル
@copyright Copyright (c) 2024 Yamanoi Yasushi.
*/

//ライブラリをインクルード
require_once("common/libs.php");

$err_array = array();
$err_flag = 0;
$page_obj = null;


//--------------------------------------------------------------------------------------
///	本体ノード
//--------------------------------------------------------------------------------------
class cmain_node extends cnode {
	//--------------------------------------------------------------------------------------
	/*!
	@brief	コンストラクタ
	*/
	//--------------------------------------------------------------------------------------
	public function __construct() {
		//親クラスのコンストラクタを呼ぶ
		parent::__construct();
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief  本体実行（表示前処理）
	@return なし
	*/
	//--------------------------------------------------------------------------------------
	public function execute(){
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	構築時の処理(継承して使用)
	@return	なし
	*/
	//--------------------------------------------------------------------------------------
	public function create(){
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief  表示(継承して使用)
	@return なし
	*/
	//--------------------------------------------------------------------------------------
	public function display(){
//PHPブロック終了
?>
<!-- コンテンツ　-->
<h1>福島県の観光地一覧</h1>

<div class="itemArea">
        <a href="./sightseeingDetail.php">
            <div class="itemImg">
                <img src="http://150.95.36.201/~k2024d/image/Ysiki.jpg" alt="image">
            </div>
            <div class="itemText">
                <h2>観光地名</h2>
            </div>
        </a>
        <a href="./sightseeingDetail.php">
            <div class="itemImg">
                <img src="http://150.95.36.201/~k2024d/image/Ysiki.jpg" alt="image">
            </div>
            <div class="itemText">
                <h2>観光地名</h2>
            </div>
        </a>
        <a href="./sightseeingDetail.php">
            <div class="itemImg">
                <img src="http://150.95.36.201/~k2024d/image/Ysiki.jpg" alt="image">
            </div>
            <div class="itemText">
                <h2>観光地名</h2>
            </div>
        </a>
        <a href="./sightseeingDetail.php">
            <div class="itemImg">
                <img src="http://150.95.36.201/~k2024d/image/Ysiki.jpg" alt="image">
            </div>
            <div class="itemText">
                <h2>観光地名</h2>
            </div>
        </a>
        <a href="./sightseeingDetail.php">
            <div class="itemImg">
                <img src="http://150.95.36.201/~k2024d/image/Ysiki.jpg" alt="image">
            </div>
            <div class="itemText">
                <h2>観光地名</h2>
            </div>
        </a>
        <a href="./sightseeingDetail.php">
            <div class="itemImg">
                <img src="http://150.95.36.201/~k2024d/image/Ysiki.jpg" alt="image">
            </div>
            <div class="itemText">
                <h2>観光地名</h2>
            </div>
        </a>
    </div>
<!-- /コンテンツ　-->
<?php 
//PHPブロック再開
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	デストラクタ
	*/
	//--------------------------------------------------------------------------------------
	public function __destruct(){
		//親クラスのデストラクタを呼ぶ
		parent::__destruct();
	}
}

//ページを作成
$page_obj = new cnode();
//ヘッダ追加
$page_obj->add_child(cutil::create('cheader'));
//本体追加
$page_obj->add_child($main_obj = cutil::create('cmain_node'));
//フッタ追加
$page_obj->add_child(cutil::create('cfooter'));
//構築時処理
$page_obj->create();
//本体実行（表示前処理）
$main_obj->execute();
//ページ全体を表示
$page_obj->display();

?>
