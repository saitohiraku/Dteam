<?php
/*!
@file hinagata.php
@brief ページ作成の雛形ファイル
*/

// ライブラリをインクルード
require_once("./common/libs.php");

session_start();

$err_array = array();
$err_flag = 0;
$page_obj = null;

// 登録フォームが送信された場合の処理
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $user = new cuser();

    if (strlen($password) < 6) {
        $err_flag = 1;
        $err_array[] = "パスワードは6文字以上である必要があります。";
    } elseif ($password !== $confirm_password) {
        $err_flag = 1;
        $err_array[] = "パスワードが一致しません。";
    } elseif ($user->is_email_taken($email)) {
        $err_flag = 1;
        $err_array[] = "このメールアドレスはすでに使用されています。別のメールアドレスを試してください。";
    } elseif ($user->create_user($username, $email, $password)) {
        header("Location: ./login.php");
        exit();
    } else {
        $err_flag = 1;
        $err_array[] = "アカウント作成に失敗しました。再試行してください。";
    }
}


//--------------------------------------------------------------------------------------
///	本体ノード
//--------------------------------------------------------------------------------------
class cmain_node extends cnode
{
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
	@brief  本体実行（表示前処理）
	@return なし
	*/
    //--------------------------------------------------------------------------------------
    public function execute()
    {
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
        global $err_flag, $err_array;
        //PHPブロック終了
?>
        <!-- コンテンツ　-->
        <div class="login-container">
            <h2>アカウント作成</h2>
            <?php if ($err_flag) { ?>
                <div class="error-message">
                    <?php foreach ($err_array as $err) { echo "<p>" . htmlspecialchars($err, ENT_QUOTES, 'UTF-8') . "</p>"; } ?>
                </div>
            <?php } ?>
            <form action="" method="post">
                <div class="input-group">
                    <label for="username">ユーザー名</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="input-group">
                    <label for="email">メールアドレス</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-group">
                    <label for="password">パスワード</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="input-group">
                    <label for="confirm_password">パスワード確認</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>
                <button type="submit">アカウント作成</button>
            </form>
            <div class="to-signin">
                <a href="./login.php">ログインはこちら</a>
            </div>
        </div>
        <!-- /全体コンテナ　-->
        </body>

        </html>
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
