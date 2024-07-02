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
	private $Nroute;
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
	@brief	idを取得
	@return	なし
	*/
    //--------------------------------------------------------------------------------------
    function get_id()
    {
        $gacha = new cstamp();
        $this->tgt_id = $gacha->get_tgt(false, "1");
    }
    //--------------------------------------------------------------------------------------
    /*!
	@brief	ルートを取得
	@return	なし
	*/
    //--------------------------------------------------------------------------------------
    function get_route($route_id)
    {
        if ($route_id) {
            $stamp = new cstamp();
            $this->route = $stamp->get_pass(false, $route_id);
        }
    }
	//--------------------------------------------------------------------------------------
    /*!
	@brief	次のルートを取得
	@return	なし
	*/
    //--------------------------------------------------------------------------------------
    function get_next_route($route_id)
    {
        if ($route_id) {
            $stamp = new cstamp();
            $this->Nroute = $stamp->get_pass(false, $route_id);
        }
    }
    //--------------------------------------------------------------------------------------
    /*!
	@brief  本体実行（表示前処理）
	@return なし
	*/
    //--------------------------------------------------------------------------------------
    public function execute()
    {
        $this->get_id();
        $this->get_route($_GET['id']);
		$this->get_next_route($_GET['id'] + 1);
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
        <div class="description"><?php echo htmlspecialchars($this->route['Route_Name'], ENT_QUOTES, 'UTF-8'); ?></div>
        <div class="content">
            <img src="<?php echo htmlspecialchars($this->route['Route_Image'], ENT_QUOTES, 'UTF-8'); ?>" alt="Food">
        </div>
        <div class="message">
            <p>3ポイントゲット！！！</p>
        </div>

        <div class="next">
            <div class="left">
                <div class="arrow"></div>
            </div>

            <div class="right">
                <div class="description">
                    <p><?php echo htmlspecialchars($this->Nroute['Route_Name'], ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
                <div class="nextContent">
                    <a href="./stampCard.php"><img src="<?php echo htmlspecialchars($this->Nroute['Route_Image'], ENT_QUOTES, 'UTF-8'); ?>" alt="Food"></a>
                </div>
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
