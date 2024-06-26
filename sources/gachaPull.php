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
	private $cnt = null;
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
	@brief  ガチャの回数を取得
	@return なし
	*/
	//--------------------------------------------------------------------------------------
	public function get_GachaCnt(){
		$gacha = new cgacha();
		$this->cnt = $gacha->get_gachaCnt(false, "1");
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief  ガチャ結果をDBに保存
	@return なし
	*/
	//--------------------------------------------------------------------------------------
	function save_gachaCnt($userId)
	{
		$servername = DB_HOST;
		$username = DB_USER;
		$password = DB_PASS;
		$dbname = DB_NAME;

		// データベース接続の作成
		$conn = new mysqli($servername, $username, $password, $dbname);

		// 接続確認
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		// User_ID が 1 のレコードを確認
		$checkQuery = "SELECT * FROM StampRally WHERE User_ID = ?";
		$stmt = $conn->prepare($checkQuery);
		$stmt->bind_param("i", $userId);
		$stmt->execute();
		$result = $stmt->get_result();

		$updateGachaCntQuery = "UPDATE Users SET User_Gacha_Cnt = User_Gacha_Cnt - 1 WHERE User_ID = ?";
        $updateGachaCntStmt = $conn->prepare($updateGachaCntQuery);
        $updateGachaCntStmt->bind_param("i", $userId);
        $updateGachaCntStmt->execute();
        $updateGachaCntStmt->close();

		$stmt->close();
		$conn->close();
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief  本体実行（表示前処理）
	@return なし
	*/
	//--------------------------------------------------------------------------------------
	public function execute(){
		$this->get_GachaCnt();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['gacha'])) {
            $this->save_gachaCnt("1");
            header("Location: ./gachaResult.php");
            exit();
        }
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
	<div class="container">
		<div class="gacha-item">
			<img src="http://150.95.36.201/~k2024d/image/ランダム正方形.png" alt="ランダムガチャ">
			<form method="post" action="">
				<button type="submit" name="gacha">引く</button>
			</form>
			<div class="smallText">残り：<?php echo htmlspecialchars($this->cnt['User_Gacha_Cnt'], ENT_QUOTES, 'UTF-8'); ?>回</div>
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
