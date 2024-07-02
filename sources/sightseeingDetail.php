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
class cmain_node extends cnode
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
	@brief  本体実行（表示前処理）
	@return なし
	*/
    //--------------------------------------------------------------------------------------
    public function execute()
    {
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
        //PHPブロック終了
?>
        <!-- コンテンツ　-->
        <div class="container">
            <div class="review">
                <h2>五色沼</h2>
                <div class="image-container">
                    <img src="http://150.95.36.201/~k2024d/image/008-750x500_c.jpg" alt="五色沼" style="width:100%; height:auto;">
                </div>
                <div class="rating-container">
                    <h3>総合評価</h3>
                    <div class="rating-box">4.0</div>
                </div>
                <div class="detail-text">
                    <p>
                        ５つの沼というわけではなく、様々な色彩を見られることから「五色沼（ごしきぬま）」という名前がつきました。色が異なる要因は、天候や季節、見る角度、水中に含まれる火山性物質などによると言われています。四季や天候、時間帯などによっても、少しずつちがった色にみえるので、一度だけでなく再び訪れてみることをおすすめします。
                    </p>
                </div>
                <div class="comment-section">
                    <h3>みんなのコメント</h3>
                    <div class="comment-form">
                        <textarea id="commentInput" placeholder="コメントを入力してください..."></textarea>
                        <button onclick="">コメントを追加</button>
                    </div>
                    <div class="commentArea">
                        <div class="comment">
                            <div class="userName">
                                ユーザー名
                            </div>
                            <div class="Sentence">
                                ここにコメントが表示されます。
                            </div>
                        </div>
                        <div class="comment">
                            <div class="userName">
                                ユーザー名
                            </div>
                            <div class="Sentence">
                                ここにコメントが表示されます。
                            </div>
                        </div>
                        <div class="comment">
                            <div class="userName">
                                ユーザー名
                            </div>
                            <div class="Sentence">
                                ここにコメントが表示されます。
                            </div>
                        </div>
                    </div>
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
    public function __destruct()
    {
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