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
class cmain_node extends cnode {
	private $cnt = null;
	private $gachaPull = null;

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
	@brief	ランダムに場所を取得
	@return	なし
	*/
	//--------------------------------------------------------------------------------------
	function get_rundum_gacha()
	{
		$gacha = new cgacha();
		$this->gachaPull = $gacha->get_rundum(false);
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
	function save_gacha_result($userId, $tdId, $cnt)
	{
		// User_ID が 1 のレコードを確認
		$stamp = new cstamp();
		$stamp_row = $stamp->get_tgt(false, $_SESSION['tmD2024_use']['User_ID']);


		if ($stamp_row && isset($stamp_row['TD_ID'])) {
			// 既存のレコードがある場合、更新する
			$dataarr = array(
				'TD_ID' => $tdId,
				'Pass_Conf' => 0
			);
			$where = 'User_ID = :User_ID';
			$where_arr = array(':User_ID' => $userId);
			$stamp->update_core(false, 'StampRally', $dataarr, $where, $where_arr);
		} else {
			// レコードがない場合、新しく挿入する
			$dataarr = array(
				'TD_ID' => $tdId,
                'User_ID' => $userId,
                'Pass_Conf' => 0
			);
			$stamp->insert_core(false, 'StampRally', $dataarr, false);
		}

		$dataarr = array(
			'User_Gacha_Cnt' => $cnt - 1
		);
		$where = 'User_ID = :User_ID';
		$where_arr = array(':User_ID' => $userId);
		$stamp->update_core(false, 'Users', $dataarr, $where, $where_arr);
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
			$this->get_rundum_gacha();
			if ($this->gachaPull) {
				$this->save_gacha_result($_SESSION['tmD2024_use']['User_ID'], $this->gachaPull['TD_ID'],$this->cnt['User_Gacha_Cnt']);
			}
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
