<?php
/*!
@file hinagata.php
@brief ページ作成の雛形ファイル
@copyright Copyright (c) 2024 Yamanoi Yasushi.
*/

// ライブラリをインクルード
require_once("common/libs.php");

session_start();

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

// ログイン処理
// ログイン処理
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$usermail = $_POST['usermail'];
	$password = $_POST['password'];
	
	$sql = $conn->prepare("SELECT User_ID, User_PassWord FROM Users WHERE User_MailAddress = ?");
	$sql->bind_param("s", $usermail);
	$sql->execute();
	$result = $sql->get_result();
	
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$user_id = $row['User_ID'];
		$stored_password = $row['User_PassWord'];
		
		if ($password === $stored_password) {
			// ログイン成功
			$_SESSION['user_id'] = $user_id;
			header("Location: index.php");
			exit();
		} else {
			$err_array[] = "パスワードが正しくありません。";
		}
	} else {
		$err_array[] = "メールアドレスが見つかりません。";
	}
}

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
		// 親クラスのコンストラクタを呼ぶ
		parent::__construct();
	}
	
	//--------------------------------------------------------------------------------------
	/*!
	@brief 本体実行（表示前処理）
	@return なし
	*/
	//--------------------------------------------------------------------------------------
	public function execute() {
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
		global $err_array;
		?>
		<!-- コンテンツ -->
		<div class="login-container" style="max-width: 400px; margin: auto;">
			<h2>ログイン</h2>
			<?php
			if (!empty($err_array)) {
				echo '<div class="error">';
				foreach ($err_array as $error) {
					echo '<p>' . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . '</p>';
				}
				echo '</div>';
			}
			?>
			<form action="#" method="post">
				<input type="email" name="usermail" placeholder="メールアドレス" required style="width: 100%; padding: 10px; margin: 10px 0;">
				<input type="password" name="password" placeholder="パスワード" required style="width: 100%; padding: 10px; margin: 10px 0;">
				<button type="submit" style="width: 100%; padding: 10px; margin: 10px 0;">ログイン</button>
			</form>
			<div class="create">
				<a href="./signin.php">アカウントを作成しますか？</a>
			</div>
		</div>
		<!-- /コンテンツ -->
		<?php 
	}
	
	//--------------------------------------------------------------------------------------
	/*!
	@brief デストラクタ
	*/
	//--------------------------------------------------------------------------------------
	public function __destruct() {
		// 親クラスのデストラクタを呼ぶ
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

$conn->close();
?>

