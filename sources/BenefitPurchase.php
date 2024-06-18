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
<div class="Benefit-Area">
        <h1>特典購入</h1>
        <div class="card point">
            <h2>保有ポイント：100P</h2>
        </div>
        <div class="card">
            <div class="card-header">
                App Store & iTunes ギフトカード
            </div>
            <div class="card-body">
                <img src="https://store.storeimages.cdn-apple.com/8567/as-images.apple.com/is/giftcard-email-geode-select-2021?wid=1200&hei=630&fmt=jpeg&qlt=95&.v=1705086455500">
                <p class="amount">500P</p>
                <p>交換目安：リアルタイム</p>
                <a href="#" class="exchange-link">交換する</a>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                App Store & iTunes ギフトカード
            </div>
            <div class="card-body">
                <img src="https://store.storeimages.cdn-apple.com/8567/as-images.apple.com/is/giftcard-email-geode-select-2021?wid=1200&hei=630&fmt=jpeg&qlt=95&.v=1705086455500">
                <p class="amount">500P</p>
                <p>交換目安：リアルタイム</p>
                <a href="#" class="exchange-link">交換する</a>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                App Store & iTunes ギフトカード
            </div>
            <div class="card-body">
                <img src="https://store.storeimages.cdn-apple.com/8567/as-images.apple.com/is/giftcard-email-geode-select-2021?wid=1200&hei=630&fmt=jpeg&qlt=95&.v=1705086455500">
                <p class="amount">500P</p>
                <p>交換目安：リアルタイム</p>
                <a href="#" class="exchange-link">交換する</a>
            </div>
        </div>
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
