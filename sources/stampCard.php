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
    private $tgt_id = null;
    private $arr = null;
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
	@brief	idを取得
	@return	なし
	*/
    //--------------------------------------------------------------------------------------
    function get_id()
    {
        $gacha = new cstamp();
        $this->tgt_id = $gacha->get_tgt(false, $_SESSION['tmD2024_use']['User_ID']);
    }
    //--------------------------------------------------------------------------------------
    /*!
	@brief	ルートを取得
	@return	なし
	*/
    //--------------------------------------------------------------------------------------
    function get_route($td_id)
    {
        if ($td_id) {
            $stamp = new cstamp();
            $this->arr = $stamp->get_all(false, $td_id);
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
        $this->get_route($this->tgt_id["TD_ID"]);
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
         <p><?php echo htmlspecialchars($this->tgt_id['Pass_Conf'], ENT_QUOTES, 'UTF-8'); ?></p>
        <div class="route">
            <h2>スタート</h2>
            <div class="location completedL">
                <a href="./stampCardPass.php?id=<?php echo htmlspecialchars($this->arr[0]['Route_ID'], ENT_QUOTES, 'UTF-8'); ?>" 
                style="<?php if (isset($this->tgt_id['Pass_Conf']) && $this->tgt_id['Pass_Conf'] >= 1) { echo 'pointer-events: none;'; } ?>">
                    <img src="<?php echo htmlspecialchars($this->arr[0]['Route_Image'], ENT_QUOTES, 'UTF-8'); ?>" alt="Cafe" class="main-img" 
                     style="<?php if (isset($this->tgt_id['Pass_Conf']) && $this->tgt_id['Pass_Conf'] >= 1) { echo 'opacity: 0.5;'; } ?>">
                    <?php 
                        if (isset($this->tgt_id['Pass_Conf']) && $this->tgt_id['Pass_Conf'] >= 1) {
                            echo '<img src="http://150.95.36.201/~k2024d/image/sumi-1.png" class="overlay-imgL">';
                        } 
                    ?>
                </a>
                <div class="description right">
                    <p><?php echo htmlspecialchars($this->arr[0]['Route_Name'], ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
            </div>

            <div class="Leg">
                <div class="RLeg">
                    <img src="http://150.95.36.201/~k2024d/image/AsiatoR.jpg" class="footprints">
                </div>
                <div class="LLeg"></div>
            </div>

            <div class="location R completedR">
                <div class="description left">
                    <p><?php echo htmlspecialchars($this->arr[1]['Route_Name'], ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
                <a href="./stampCardPass.php?id=<?php echo htmlspecialchars($this->arr[1]['Route_ID'], ENT_QUOTES, 'UTF-8'); ?>"
                style="<?php if (isset($this->tgt_id['Pass_Conf']) && $this->tgt_id['Pass_Conf'] >= 2) { echo 'pointer-events: none;'; } ?>">
                    <img src="<?php echo htmlspecialchars($this->arr[1]['Route_Image'], ENT_QUOTES, 'UTF-8'); ?>" alt="Cafe" class="main-img" 
                     style="<?php if (isset($this->tgt_id['Pass_Conf']) && $this->tgt_id['Pass_Conf'] >= 2) { echo 'opacity: 0.5;'; } ?>">
                    <?php 
                        if (isset($this->tgt_id['Pass_Conf']) && $this->tgt_id['Pass_Conf'] >= 2) {
                        echo '<img src="http://150.95.36.201/~k2024d/image/sumi-1.png" class="overlay-imgR">';
                    } ?>
                </a>
            </div>

            <div class="Leg">
                <div class="RLeg"></div>
                <div class="LLeg"><img src="http://150.95.36.201/~k2024d/image/AsiatoL.jpg" class="footprints"></div>
            </div>

            <div class="location L completedL">
                <a href="./stampCardPass.php?id=<?php echo htmlspecialchars($this->arr[2]['Route_ID'], ENT_QUOTES, 'UTF-8'); ?>"
                style="<?php if (isset($this->tgt_id['Pass_Conf']) && $this->tgt_id['Pass_Conf'] >= 3) { echo 'pointer-events: none;'; } ?>">
                    <img src="<?php echo htmlspecialchars($this->arr[2]['Route_Image'], ENT_QUOTES, 'UTF-8'); ?>" alt="Cafe" class="main-img" 
                     style="<?php if (isset($this->tgt_id['Pass_Conf']) && $this->tgt_id['Pass_Conf'] >= 3) { echo 'opacity: 0.5;'; } ?>">
                    <?php 
                        if (isset($this->tgt_id['Pass_Conf']) && $this->tgt_id['Pass_Conf'] >= 3) {
                        echo '<img src="http://150.95.36.201/~k2024d/image/sumi-1.png" class="overlay-imgL">';
                    } ?>
                </a>
                <div class="description right">
                    <p><?php echo htmlspecialchars($this->arr[2]['Route_Name'], ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
            </div>

            <div class="Leg">
                <div class="RLeg"><img src="http://150.95.36.201/~k2024d/image/AsiatoR.jpg" class="footprints"></div>
                <div class="LLeg">

                </div>
            </div>

            <div class="location R completedR">
                <div class="description left">
                    <p><?php echo htmlspecialchars($this->arr[3]['Route_Name'], ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
                <a href="./stampCardPass.php?id=<?php echo htmlspecialchars($this->arr[3]['Route_ID'], ENT_QUOTES, 'UTF-8'); ?>"
                style="<?php if (isset($this->tgt_id['Pass_Conf']) && $this->tgt_id['Pass_Conf'] >= 4) { echo 'pointer-events: none;'; } ?>">
                    <img src="<?php echo htmlspecialchars($this->arr[3]['Route_Image'], ENT_QUOTES, 'UTF-8'); ?>" alt="Cafe" class="main-img"
                     style="<?php if (isset($this->tgt_id['Pass_Conf']) && $this->tgt_id['Pass_Conf'] >= 4) { echo 'opacity: 0.5;'; } ?>">
                    <?php 
                        if (isset($this->tgt_id['Pass_Conf']) && $this->tgt_id['Pass_Conf'] >= 4) {
                        echo '<img src="http://150.95.36.201/~k2024d/image/sumi-1.png" class="overlay-imgR">';
                    } ?>
                </a>
            </div>

            <div class="Leg">
                <div class="RLeg">

                </div>
                <div class="LLeg"><img src="http://150.95.36.201/~k2024d/image/AsiatoL.jpg" class="footprints"></div>
            </div>

            <h2>ゴール！</h2>
            <div class="location L completedL">
                <a href="./stampCardPass.php?id=<?php echo htmlspecialchars($this->arr[4]['Route_ID'], ENT_QUOTES, 'UTF-8'); ?>"
                style="<?php if (isset($this->tgt_id['Pass_Conf']) && $this->tgt_id['Pass_Conf'] >= 5) { echo 'pointer-events: none;'; } ?>">
                    <img src="<?php echo htmlspecialchars($this->arr[4]['Route_Image'], ENT_QUOTES, 'UTF-8'); ?>" alt="Cafe" class="main-img"
                     style="<?php if (isset($this->tgt_id['Pass_Conf']) && $this->tgt_id['Pass_Conf'] >= 5) { echo 'opacity: 0.5;'; } ?>">
                    <?php 
                        if (isset($this->tgt_id['Pass_Conf']) && $this->tgt_id['Pass_Conf'] >= 5) {
                        echo '<img src="http://150.95.36.201/~k2024d/image/sumi-1.png" class="overlay-imgL">';
                    } ?>
                </a>
                <div class="description right">
                    <p><?php echo htmlspecialchars($this->arr[4]['Route_Name'], ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
            </div>
        </div>

        <!-- /コンテンツ　-->
    </script>
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