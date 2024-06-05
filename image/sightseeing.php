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

// データベース接続情報
$host = 'your_host';
$db = 'your_database';
$user = 'your_username';
$pass = 'your_password';

// データベース接続を作成
$conn = new mysqli($host, $user, $pass, $db);

// 接続をチェック
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// データベースからデータを取得
$sql = "SELECT name, image_url FROM sightseeing_places";
$result = $conn->query($sql);

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
        global $result;
        //PHPブロック終了
?>
<!-- コンテンツ -->
<h1>福島県の観光地一覧</h1>

<div class="itemArea">
<?php
if ($result->num_rows > 0) {
    // 取得したデータを出力
    while($row = $result->fetch_assoc()) {
        echo '<a href="./sightseeingDetail.php">';
        echo '    <div class="itemImg">';
        echo '        <img src="' . $row["image_url"] . '" alt="image">';
        echo '    </div>';
        echo '    <div class="itemText">';
        echo '        <h2>' . $row["name"] . '</h2>';
        echo '    </div>';
        echo '</a>';
    }
} else {
    echo "観光地情報がありません。";
}
?>
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
    public function __destruct(){
        //親クラスのデストラクタを呼ぶ
        parent::__destruct();
    }
}

// ページを作成
$page_obj = new cnode();
// ヘッダ追加
$page_obj->add_child(cutil::create('cheader'));
// 本体追加
$page_obj->add_child($main_obj = cutil::create('cmain_node'));
// フッタ追加
$page_obj->add_child(cutil::create('cfooter'));
// 構築時処理
$page_obj->create();
// 本体実行（表示前処理）
$main_obj->execute();
// ページ全体を表示
$page_obj->display();

// データベース接続を閉じる
$conn->close();
?>
