<?php
/*!
@file sightseeingDetail.php
@brief 観光地詳細ページ
*/

require_once(__DIR__ . "/common/libs.php");

$err_array = array();
$err_flag = 0;
$page_obj = null;

// データベース接続情報
$host = 'localhost';
$db = 'k2024ddb';
$user = 'k2024ddb';
$pass = 'TKXZRzx7fhBOa81T!';

// データベース接続を作成
$conn = new mysqli($host, $user, $pass, $db);

// 接続をチェック
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// URLのクエリパラメータから観光地IDを取得
$id = isset($_GET['TD_ID']) ? $_GET['TD_ID'] : '';

if (!empty($id)) {
    // データベースから観光地の詳細情報を取得
    $id = $conn->real_escape_string($id); // SQLインジェクション対策
    
    $sql = "SELECT TD_Name, TD_Photo, TD_Detail, TD_Eva FROM TouristDestinations_Main WHERE TD_ID = '$id'";
    $result = $conn->query($sql);
    
    if ($result) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $name = $row["TD_Name"];
            $photo = $row["TD_Photo"];
            $detail = $row["TD_Detail"];
            $eva = $row["TD_Eva"];
        } else {
            die("No records found");
        }
        $result->close();
    } else {
        die("Query failed: " . $conn->error);
    }
} else {
    die("Invalid ID");
}

$conn->close();

//--------------------------------------------------------------------------------------
/// 本体ノード
//--------------------------------------------------------------------------------------
class cmain_node extends cnode
{
    private $name;
    private $photo;
    private $detail;
    private $eva;
    
    //--------------------------------------------------------------------------------------
    /*!
    @brief コンストラクタ
    */
    //--------------------------------------------------------------------------------------
    public function __construct($name, $photo, $detail, $eva)
    {
        //親クラスのコンストラクタを呼ぶ
        parent::__construct();
        $this->name = $name;
        $this->photo = $photo;
        $this->detail = $detail;
        $this->eva = $eva;
    }
    //--------------------------------------------------------------------------------------
    /*!
    @brief 本体実行（表示前処理）
    @return なし
    */
    //--------------------------------------------------------------------------------------
    public function execute()
    {
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
        ?>
        <!-- コンテンツ -->
        <div class="container">
            <h2><?php echo htmlspecialchars($this->name, ENT_QUOTES, 'UTF-8'); ?>⭐️</h2>
            <div class="image-container">
                <img src="<?php echo htmlspecialchars($this->photo, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($this->name, ENT_QUOTES, 'UTF-8'); ?>" style="width:100%; height:auto;">
            </div>
            <div class="rating-container">
                <h3>総合評価</h3>
                <div class="rating-box"><?php echo htmlspecialchars($this->eva, ENT_QUOTES, 'UTF-8'); ?></div>
            </div>
            <div class="detail-text">
                <p><?php echo nl2br(htmlspecialchars($this->detail, ENT_QUOTES, 'UTF-8')); ?></p>
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
        
        <?php
    }
    //--------------------------------------------------------------------------------------
    /*!
    @brief デストラクタ
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
$page_obj->add_child($main_obj = new cmain_node($name, $photo, $detail, $eva));
//フッタ追加
$page_obj->add_child(cutil::create('cfooter'));
//構築時処理
$page_obj->create();
//本体実行（表示前処理）
$main_obj->execute();
//ページ全体を表示
$page_obj->display();
?>
