<?php
/*!
@file index.php
@brief メインメニュー
*/

//ライブラリをインクルード
require_once("common/libs.php");
// ログインチェックを行うファイルをインクルード
require_once("auth_check.php");

//--------------------------------------------------------------------------------------
/// 本体ノード
//--------------------------------------------------------------------------------------
class cmain_node extends cnode {
    //--------------------------------------------------------------------------------------
    /*!
    @brief コンストラクタ
    */
    //--------------------------------------------------------------------------------------
    public function __construct() {
        //親クラスのコンストラクタを呼ぶ
        parent::__construct();
    }
    //--------------------------------------------------------------------------------------
    /*!
    @brief 本体実行（表示前処理）
    @return なし
    */
    //--------------------------------------------------------------------------------------
    public function execute(){
    }
    //--------------------------------------------------------------------------------------
    /*!
    @brief 構築時の処理(継承して使用)
    @return なし
    */
    //--------------------------------------------------------------------------------------
    public function create(){
    }
    //--------------------------------------------------------------------------------------
    /*!
    @brief 表示(継承して使用)
    @return なし
    */
    //--------------------------------------------------------------------------------------
    public function display(){
        //PHPブロック終了
?>

<!-- コンテンツ　-->
    <div class="home">
        <div class="info">
            巡ったスポット数 13<br>
            保有ポイント数 100P
        </div>
        <div class="gacha">
            <div class="image">
                <img src="http://150.95.36.201/~k2024d/image/ticket.png" alt="Ticket">
            </div>
            <div class="button">
                <a href="./gachaSelect.php">ガ チ ャ</a>
            </div>
        </div>
        <div class="stamp-rally">
            <div class="button">
                <a href="./stampCard.php">ス タ ン プ カ ー ド</a>
            </div>
            <div class="image">
                <img src="http://150.95.36.201/~k2024d/image/stamp_card.png" alt="Stamp Card">
            </div>
        </div>
        <div class="sightseeing">
            <div class="image">
                <img src="http://150.95.36.201/~k2024d/image/guide.png" alt="Guide">
            </div>
            <div class="button">
                <a href="./sightseeing.php">観 光 地 一 覧</a>
            </div>
        </div>
        <div class="stamp-rally">
            <div class="button">
                <a href="./BenefitPurchase.php">特 典 購 入</a>
            </div>
            <div class="image">
                <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEhPvR0IoVg7EaT62sGHSAL6iwrnceJW-nqMEICZS8Ytp9zeXfEprkABh24jgx5kDfYlt7tHcPMTSAQZV0s-WyoGqwMfTMUu1Y5mO7f511joVlMIowbVwqFbKNrt-Mdzd-dbn0T5EcqoB98/s800/ticket_syouhinken.png" alt="BenefitPurchase">
            </div>
        </div>

        <div class="usage">
            <a href="./overview.php">サービス概要はこちら</a>
        </div>
    </div>
<!-- /コンテンツ　-->
<?php 
//PHPブロック再開
    }
    //--------------------------------------------------------------------------------------
    /*!
    @brief デストラクタ
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
