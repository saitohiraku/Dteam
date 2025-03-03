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
	private $randomSpot = null;

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
	@brief	ランダムに場所を取得
	@return	なし
	*/
	//--------------------------------------------------------------------------------------
	function get_rundum_gacha()
	{
		$gacha = new cgacha();
		$this->randomSpot = $gacha->get_rundum(false);
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
	function save_gacha_result($userId, $tdId)
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

		if ($result->num_rows > 0) {
			// 既存のレコードがある場合、更新する
			$updateQuery = "UPDATE StampRally SET TD_ID = ?, Pass_Conf = 0 WHERE User_ID = ?";
            $updateStmt = $conn->prepare($updateQuery);
            $updateStmt->bind_param("ii", $tdId, $userId);
            $updateStmt->execute();
            $updateStmt->close();
		} else {
			// レコードがない場合、新しく挿入する
			$insertQuery = "INSERT INTO StampRally (TD_ID, User_ID) VALUES (?, ?)";
			$insertStmt = $conn->prepare($insertQuery);
			$insertStmt->bind_param("ii", $tdId, $userId);
			$insertStmt->execute();
			$insertStmt->close();
		}

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
	public function execute()
	{
		// ガチャの回数を取得
        $this->get_GachaCnt();

        // ガチャ回数が0以下の場合、処理を終了
        if ($this->cnt['User_Gacha_Cnt'] <= 0) {
            $this->randomSpot = null;
            return;
        }

        // ランダムに観光地を取得
        $this->get_rundum_gacha();

        // ガチャ結果をDBに保存
        if ($this->randomSpot) {
            $this->save_gacha_result("1", $this->randomSpot['TD_ID']);
        }
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
            <div class="gacha-item">
                <h1>結果</h1>
                <div class="result">
                    <?php if ($this->randomSpot) { ?>
                        <h2><?php echo htmlspecialchars($this->randomSpot['TD_Name'], ENT_QUOTES, 'UTF-8'); ?></h2>
                        <img src="<?php echo htmlspecialchars($this->randomSpot['TD_Photo'], ENT_QUOTES, 'UTF-8'); ?>" alt="ランダムガチャ">
                    <?php } else { ?>
                        <p>ガチャ券が足りません。</p>
                    <?php } ?>
                </div>

                <button onclick="window.location.reload();">引き直す</button>
                <div class="smallText">残り：<?php echo htmlspecialchars($this->cnt['User_Gacha_Cnt'], ENT_QUOTES, 'UTF-8'); ?>回</div>
                <div class="button">
                    <a href="./stampCard.php">スタンプカードへ</a>
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
