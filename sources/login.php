<?php
/*!
@file hinagata.php
@brief ページ作成の雛形ファイル
*/

//ライブラリをインクルード
require_once("./common/libs.php");

session_start();

$err_array = array();
$err_flag = 0;
$page_obj = null;

$ERR_STR = "";
$user_master_id = "";
$user_email = "";

//--------------------------------------------------------------------------------------
/// 本体ノード
//--------------------------------------------------------------------------------------
class cmain_node extends cnode
{
    //--------------------------------------------------------------------------------------
    /*!
    @brief コンストラクタ
    */
    //--------------------------------------------------------------------------------------
    public function __construct()
    {
        //親クラスのコンストラクタを呼ぶ
        parent::__construct();
    }

    //--------------------------------------------------------------------------------------
    /*!
    @brief 本体実行（表示前処理）
    @return なし
    */
    //--------------------------------------------------------------------------------------
    public function execute()
    {
        global $ERR_STR;
        global $user_master_id;
        global $user_email;

        if (isset($_SESSION['tmD2024_use']['err']) && $_SESSION['tmD2024_use']['err'] != "") {
            $ERR_STR = $_SESSION['tmD2024_use']['err'];
        }

        //このセッションをクリア
        $_SESSION['tmD2024_use'] = array();

        if (isset($_POST['email']) && isset($_POST['password'])) {
            if ($this->chk_user_login(
                strip_tags($_POST['email']),
                strip_tags($_POST['password']))) {
                $_SESSION['tmD2024_use']['email'] = strip_tags($_POST['email']);
                $_SESSION['tmD2024_use']['User_ID'] = $user_master_id;
                $_SESSION['tmD2024_use']['user_email'] = $user_email;

                // デバッグメッセージ
                error_log("Login successful. Redirecting to index.php");

                cutil::redirect_exit("./index.php");
                exit(); // 追加: リダイレクト後にスクリプトの実行を停止
            } else {
                $ERR_STR .= "メールアドレスまたはパスワードが正しくありません。\n";
            }
        }
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
    @brief ログインのチェック
    @return メンバーID
    */
    //--------------------------------------------------------------------------------------
    function chk_user_login($user_login, $user_password)
    {
        global $ERR_STR;
        global $user_master_id;
        global $user_email;
        $user = new cuser();
        $row = $user->get_tgt_login(false, $user_login);

        if ($row === false || !isset($row['User_MailAddress'])) {
            $ERR_STR .= "メールアドレスが違っています。\n";
            return false;
        }

        // ハッシュ化されたパスワードの検証
        if (!password_verify($user_password, $row['User_PassWord'])) {
            $ERR_STR .= "パスワードが違っています。\n";
            return false;
        }
        $user_master_id = $row['User_ID'];
        $user_email = $row['User_MailAddress'];
        return true;
    }

    //--------------------------------------------------------------------------------------
    /*!
    @brief 表示(継承して使用)
    @return なし
    */
    //--------------------------------------------------------------------------------------
    public function display()
    {
        global $ERR_STR;
        //PHPブロック終了
?>
        <!-- コンテンツ -->
        <div class="login-container">
            <h2>ログイン</h2>
            <p class="text-danger"><?= cutil::ret2br($ERR_STR); ?></p>
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="input-group">
                    <label for="email">メールアドレス</label>
                    <input type="text" id="email" name="email" required>
                </div>
                <div class="input-group">
                    <label for="password">パスワード</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">ログイン</button>
            </form>
            <div class="to-signin">
                <a href="./signin.php">新規の方はこちら</a>
            </div>
        </div>
        <!-- /全体コンテナ -->
        </body>

        </html>
        <!-- /コンテンツ -->
<?php
        //PHPブロック再開
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
$page_obj->add_child(cutil::create('admin_signin_login'));
//本体追加
$page_obj->add_child($main_obj = cutil::create('cmain_node'));
//構築時処理
$page_obj->create();
//本体実行（表示前処理）
$main_obj->execute();
//ページ全体を表示
$page_obj->display();

?>
