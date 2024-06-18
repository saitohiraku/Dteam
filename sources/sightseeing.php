<?php
/*!
@file hinagata.php
@brief ページ作成の雛形ファイル
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

// データベースからデータを取得
$sql = "SELECT TD_ID, TD_Name, TD_Photo FROM TouristDestinations_Main";
$result = $conn->query($sql);

class cmain_node extends cnode {
    public function __construct() {
        parent::__construct();
    }
    public function execute(){
    }
    public function create(){
    }
    public function display(){
        global $result;
        ?>
        <h1>福島県の観光地一覧</h1>
        <div class="itemArea">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<a href="./sightseeingDetail.php?TD_ID=' . intval($row["TD_ID"]) . '">';
                    echo '    <div class="itemImg">';
                    echo '        <img src="' . htmlspecialchars($row["TD_Photo"], ENT_QUOTES, 'UTF-8') . '" alt="' . htmlspecialchars($row["TD_Name"], ENT_QUOTES, 'UTF-8') . '">';
                    echo '    </div>';
                    echo '    <div class="itemText">';
                    echo '        <h2>' . htmlspecialchars($row["TD_Name"], ENT_QUOTES, 'UTF-8') . '</h2>';
                    echo '    </div>';
                    echo '</a>';
                }
            } else {
                echo "観光地情報がありません。";
            }
            ?>
        </div>
        <?php 
    }
    public function __destruct(){
        parent::__destruct();
    }
}

$page_obj = new cnode();
$page_obj->add_child(cutil::create('cheader'));
$page_obj->add_child($main_obj = cutil::create('cmain_node'));
$page_obj->add_child(cutil::create('cfooter'));
$page_obj->create();
$main_obj->execute();
$page_obj->display();

$conn->close();
?>
