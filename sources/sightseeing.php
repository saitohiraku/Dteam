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
class cmain_node extends cnode {
    private $destinations;

    //--------------------------------------------------------------------------------------
    /*!
    @brief コンストラクタ
    */
    //--------------------------------------------------------------------------------------
    public function __construct() {
        parent::__construct();
    }

    //--------------------------------------------------------------------------------------
    /*!
    @brief 本体実行（表示前処理）
    @return なし
    */
    //--------------------------------------------------------------------------------------
    public function execute() {
        $touristDest = new ctd();
        $this->destinations = $touristDest->get_all();
    }

    //--------------------------------------------------------------------------------------
    /*!
    @brief 構築時の処理(継承して使用)
    @return なし
    */
    //--------------------------------------------------------------------------------------
    public function create() {
    }

    //--------------------------------------------------------------------------------------
    /*!
    @brief 表示(継承して使用)
    @return なし
    */
    //--------------------------------------------------------------------------------------
    public function display() {
        //PHPブロック終了
?>
<!-- コンテンツ -->
<div class="contents">
    <h1>福島県の観光地一覧</h1>
    <div class="itemArea">
        <?php if (!empty($this->destinations)): ?>
            <?php foreach ($this->destinations as $row): ?>
                <a href="./sightseeingDetail.php?TD_ID=<?php echo intval($row['TD_ID']); ?>">
                    <div class="itemImg">
                        <img src="<?php echo htmlspecialchars($row['TD_Photo'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($row['TD_Name'], ENT_QUOTES, 'UTF-8'); ?>">
                    </div>
                    <div class="itemText">
                        <h2><?php echo htmlspecialchars($row['TD_Name'], ENT_QUOTES, 'UTF-8'); ?></h2>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <p>観光地情報がありません。</p>
        <?php endif; ?>
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
    public function __destruct() {
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
