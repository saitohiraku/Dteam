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
        <div class="contents">
            <h1>よくある質問</h1>
            <div class="faq">
                <h2>質問1: 商品の配送にはどれくらい時間がかかりますか？</h2>
                <p>通常、ご注文から3〜5営業日以内に商品をお届けいたします。ただし、配送地域や在庫状況により異なる場合がございます。</p>
            </div>
            <div class="faq">
                <h2>質問2: 返品ポリシーはどのようになっていますか？</h2>
                <p>商品に不具合がある場合、またはご満足いただけない場合は、商品到着後30日以内にご連絡いただければ返品・交換を承ります。</p>
            </div>
            <div class="faq">
                <h2>質問3: 支払い方法にはどのようなものがありますか？</h2>
                <p>クレジットカード、デビットカード、銀行振込、代金引換、PayPalなど、多様な支払い方法をご利用いただけます。</p>
            </div>
            <div class="faq">
                <h2>質問4: 会員登録は必要ですか？</h2>
                <p>いいえ、会員登録をせずにご購入いただくことも可能です。ただし、会員登録をしていただくと、次回以降のご注文がスムーズになります。</p>
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