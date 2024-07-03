<?php
/*!
@file hinagata.php
@brief ページ作成の雛形ファイル
@copyright Copyright (c) 2024 Yamanoi Yasushi.
*/

//ライブラリをインクルード
require_once("common/libs.php");
// ログインチェックを行うファイルをインクルード
require_once("auth_check.php");

$err_array = array();
$err_flag = 0;
$page_obj = null;



//--------------------------------------------------------------------------------------
/// 本体ノード
//--------------------------------------------------------------------------------------
class cmain_node extends cnode
{
    private $detail;

    //--------------------------------------------------------------------------------------
    /*!
    @brief コンストラクタ
    */
    //--------------------------------------------------------------------------------------
    public function __construct()
    {
        parent::__construct();
    }

    //--------------------------------------------------------------------------------------
    /*!
    @brief 本体実行（表示前処理）
    @return なし
    */
    //--------------------------------------------------------------------------------------
    public function execute()
    {
        // URLのクエリパラメータから観光地IDを取得
        $id = isset($_GET['TD_ID']) ? $_GET['TD_ID'] : '';

        $touristDest = new ctd();
        $this->detail = $touristDest->get_tgt(false, $id);
    }

    //--------------------------------------------------------------------------------------
    /*!
    @brief 構築時の処理(継承して使用)
    @return なし
    */
    //--------------------------------------------------------------------------------------
    public function create()
    {
    }

    //--------------------------------------------------------------------------------------
    /*!
    @brief 表示(継承して使用)
    @return なし
    */
    //--------------------------------------------------------------------------------------
    public function display()
    {
        //PHPブロック終了
?>
        <!-- コンテンツ -->
        <div class="container">
            <h2><?php echo htmlspecialchars($this->detail['TD_Name'], ENT_QUOTES, 'UTF-8'); ?>⭐️</h2>
            <div class="image-container">
                <img src="<?php echo htmlspecialchars($this->detail['TD_Photo'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($this->detail['TD_Name'], ENT_QUOTES, 'UTF-8'); ?>" style="width:100%; height:auto;">
            </div>
            <div class="rating-container">
                <h3>総合評価</h3>
                <div class="rating-box"><?php echo htmlspecialchars($this->detail['TD_Eva'], ENT_QUOTES, 'UTF-8'); ?></div>
            </div>
            <div class="detail-text">
                <p><?php echo nl2br(htmlspecialchars($this->detail['TD_Detail'], ENT_QUOTES, 'UTF-8')); ?></p>
            </div>
            <div class="comment-section">
                <h3>みんなのコメント</h3>
                <div class="comment-form">
                    <textarea id="commentInput" placeholder="コメントを入力してください..."></textarea>
                    <button onclick="addComment()">コメントを追加</button>
                </div>
                <div class="commentArea" id="commentsDisplay">
                    <!-- コメントがここに表示されます -->
                </div>
            </div>
        </div>
        <!-- /コンテンツ -->
<?php
        //PHPブロック再開
    }

    //--------------------------------------------------------------------------------------
    /*!
    @brief デストラクタ
    */
    //--------------------------------------------------------------------------------------
    public function __destruct()
    {
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