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
    private $cnt = null;
    private $gachaPull = null;
    private $touristDestination = null;

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
    @brief ガチャの回数を取得
    @return なし
    */
    //--------------------------------------------------------------------------------------
    public function get_GachaCnt(){
        $gacha = new cgacha();
        $this->cnt = $gacha->get_gachaCnt(false, $_SESSION['tmD2024_use']['User_ID']);
    }

    //--------------------------------------------------------------------------------------
    /*!
    @brief 観光地情報を取得
    @return なし
    */
    public function get_TouristDestination()
    {
        $gacha = new ctd();
        $this->touristDestination = $gacha->get_TouristDestination($_SESSION['tmD2024_use']['User_ID']);
    }

    //--------------------------------------------------------------------------------------
    /*!
    @brief 本体実行（表示前処理）
    @return なし
    */
    //--------------------------------------------------------------------------------------
    public function execute()
    {
        // ガチャの回数を取得
        $this->get_GachaCnt();

        // ガチャ回数が0以下の場合、処理を終了
        if ($this->cnt['User_Gacha_Cnt'] <= 0) {
            $this->gachaPull = null;
            return;
        }

        // 観光地情報を取得
        $this->get_TouristDestination();
    }

    //--------------------------------------------------------------------------------------
    /*!
    @brief 構築時の処理(継承して使用)
    @return なし
    */
    public function create()
    {
    }

    //--------------------------------------------------------------------------------------
    /*!
    @brief 表示(継承して使用)
    @return なし
    */
    public function display()
    {
        //PHPブロック終了
?>
    <!-- コンテンツ -->
    <div class="container">
        <div class="gacha-item">
            <h1>結果</h1>
            <?php if ($this->touristDestination): ?>
            <div class="result">
                <h2><?php echo htmlspecialchars($this->touristDestination['TD_Name'], ENT_QUOTES, 'UTF-8'); ?></h2>
                <img src="<?php echo htmlspecialchars($this->touristDestination['TD_Photo'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($this->touristDestination['TD_Name'], ENT_QUOTES, 'UTF-8'); ?>">
            </div>
            <?php else: ?>
            <div class="result">
                <p>観光地情報が取得できませんでした。</p>
            </div>
            <?php endif; ?>

            <button onclick="">引き直す</button>
            <div class="smallText">残り：<?php echo htmlspecialchars($this->cnt['User_Gacha_Cnt'], ENT_QUOTES, 'UTF-8'); ?>回</div>
            <div class="button">
                <a href="./stampCard.php">スタンプカードへ</a>
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
