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
	<div class="route">
        <h2>スタート</h2>
        <div class="location ">
            <a href="./stampCardPass.php"><img src="http://150.95.36.201/~k2024d/image/cafe.jpg" alt="Cafe"></a>
            <div class="description right">
                <p>カフェ</p>
            </div>
        </div>

        <div class="Leg">
            <div class="RLeg">
                <img src="http://150.95.36.201/~k2024d/image/AsiatoR.jpg" class="footprints"></div>
            <div class="LLeg"></div>
        </div>

        <div class="location R">
            <div class="description left">
                <p>お城</p>
            </div>
            <a href="./stampCardPass.php"><img src="http://150.95.36.201/~k2024d/image/castle.jpg" alt="Castle"></a>
        </div>

        <div class="Leg">
            <div class="RLeg"></div>
            <div class="LLeg"><img src="http://150.95.36.201/~k2024d/image/AsiatoL.jpg" class="footprints"></div>
        </div>

        <div class="location L">
            <a href="./stampCardPass.php"><img src="http://150.95.36.201/~k2024d/image/chashitu.jpg" alt="Tea Room"></a>
            <div class="description right">
                <p>茶室</p>
            </div>
        </div>

        <div class="Leg">
            <div class="RLeg"><img src="http://150.95.36.201/~k2024d/image/AsiatoR.jpg" class="footprints"></div>
            <div class="LLeg">
                
            </div>
        </div>

        <div class="location R">
            <div class="description left">
                <p>富士山</p>
            </div>
            <a href="./stampCardPass.php"><img src="http://150.95.36.201/~k2024d/image/fujiyama.jpg" alt="Mount Fuji"></a>
        </div>

        <div class="Leg">
            <div class="RLeg">
                
            </div>
            <div class="LLeg"><img src="http://150.95.36.201/~k2024d/image/AsiatoL.jpg" class="footprints"></div>
        </div>

        <h2>ゴール！</h2>
        <div class="location L">
            <a href="./stampCardPass.php"><img src="http://150.95.36.201/~k2024d/image/Soba.jpg" alt="Soba"></a>
            <div class="description right">
                <p>蕎麦</p>
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
