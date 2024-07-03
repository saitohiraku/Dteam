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
///	本体ノード
//--------------------------------------------------------------------------------------
class cmain_node extends cnode
{
	private $pass = null;
	private $route = null;
	private $error_message = null;

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
	@brief  パス確認用カウントを取得
	@return なし
	*/
	//--------------------------------------------------------------------------------------
	public function get_pass_conf($id)
	{
		$stamp = new cstamp();
		$this->pass = $stamp->get_tgt(false, $id);
	}

	
	//--------------------------------------------------------------------------------------
	/*!
	@brief  パスを取得
	@return なし
	*/
	//--------------------------------------------------------------------------------------
	public function get_route($id)
	{
		$db_route = new cstamp();
		$this->route = $db_route->get_pass(false, $id);
	}
	
	//--------------------------------------------------------------------------------------
	/*!
    @brief StampRally_test の Pass_Conf を更新
    @return bool 更新が成功したかどうか
    */
	//--------------------------------------------------------------------------------------
	public function update_pass_conf($id, $pass_conf)
	{
		$stamp = new cstamp();
		$dataarr = array(
			'Pass_Conf' => $pass_conf + 1
		);
		$where = 'User_ID = :User_ID';
		$prep_arr = array(':User_ID' => $id);
		$stamp->update_core(false, 'StampRally', $dataarr, $where, $prep_arr);

		
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief  本体実行（表示前処理）
	@return なし
	*/
	//--------------------------------------------------------------------------------------
	public function execute()
	{
		$this->get_pass_conf($_SESSION['tmD2024_use']['User_ID']);

		if (isset($_POST['password']) && isset($_GET['id'])) {
			$this->get_route($_GET['id']);
			$input_password = $_POST['password'];
			if ($input_password === $this->route['Route_Pass']) {
				$this->update_pass_conf($_SESSION['tmD2024_use']['User_ID'], $this->pass['Pass_Conf']);
				header('Location: ./stampCardGetPoint.php?id=' . urlencode($_GET['id']));
				exit();
			} else {
				$this->error_message = "パスワードが正しくありません。";
			}
		} elseif (isset($_GET['id'])) {
			$this->get_route($_GET['id']);
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
		<p><?php echo htmlspecialchars($this->route['Route_Pass'], ENT_QUOTES, 'UTF-8'); ?></p>
		<div class="pass-Area">
			<div class="description"><?php echo htmlspecialchars($this->route['Route_Name'], ENT_QUOTES, 'UTF-8'); ?></div>
			<div class="content">
				<img src="<?php echo htmlspecialchars($this->route['Route_Image'], ENT_QUOTES, 'UTF-8'); ?>" alt="Food">
			</div>
			<div class="password">
				<p>店員パスワード</p>
			</div>
			<form method="post" action="">
				<div class="input-container">
					<?php if ($this->error_message) { ?>
						<p style="color: red;"><?php echo htmlspecialchars($this->error_message, ENT_QUOTES, 'UTF-8'); ?></p>
					<?php } ?>
					<input type="password" name="password" placeholder="パスワード">
					<button type="submit">確定</button>
				</div>
			</form>
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