<?php
/*!
@file contents_db.php
@brief 
@copyright Copyright (c) 2024 Yamanoi Yasushi.
*/

//--------------------------------------------------------------------------------------
///	観光地クラス
//--------------------------------------------------------------------------------------
class ctd extends crecord
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
	@brief	指定した範囲を返す
	@param[in]	$debug	デバッグ出力をするかどうか
	@param[in]	$td_id　観光地ID
	@return	個数
	*/
	//--------------------------------------------------------------------------------------
	public function get_tgt($debug, $td_id)
	{
		//プレースホルダつき
		$query = <<< END_BLOCK
select
TD_ID,
TD_Name,
TD_Photo,
TD_PassWord
from
TouristDestinations_Main
where
TD_ID = :TD_ID
END_BLOCK;
		$prep_arr = array(
			':TD_ID' => (string)$td_id
		);

		// 親クラスのselect_query()メンバ関数を呼ぶ
		$this->select_query(
			$debug,         // デバッグ表示するかどうか
			$query,         // プレースホルダつきSQL
			$prep_arr       // データの配列
		);
		if ($row = $this->fetch_assoc()) {
			//取得したデータを返す
			return $row;
		} else {
			return null;
		}
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

//--------------------------------------------------------------------------------------
///	ガチャクラス
//--------------------------------------------------------------------------------------
class cgacha extends crecord
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
	@brief	すべての個数を得る
	@param[in]	$debug	デバッグ出力をするかどうか
	@return	個数
	*/
	//--------------------------------------------------------------------------------------
	public function get_rundum($debug)
	{
		//プレースホルダつき
		$query = <<< END_BLOCK
select
TD_ID,
TD_Name,
TD_Photo
from
TouristDestinations
order by
rand()
limit 1
END_BLOCK;
		//空のデータ
		$prep_arr = array();
		//親クラスのselect_query()メンバ関数を呼ぶ
		$this->select_query(
			$debug,			//デバッグ表示するかどうか
			$query,			//プレースホルダつきSQL
			$prep_arr		//データの配列
		);
		if ($row = $this->fetch_assoc()) {
			//取得した観光地と画像を返す
			return $row;
		} else {
			return null;
		}
	}

	//--------------------------------------------------------------------------------------
	/*!
@brief  ガチャを引く回数を取得する
@param[in]  $debug  デバッグ出力をするかどうか
@param[in]  $gachaCnt　ガチャのカウント
@return 個数
*/
	//--------------------------------------------------------------------------------------
	public function get_gachaCnt($debug, $gachaCnt)
	{
		if (!cutil::is_number($gachaCnt) || $gachaCnt < 1) {
			// falseを返す
			return false;
		}

		// プレースホルダつき
		$query = <<<END_BLOCK
SELECT
User_Gacha_Cnt
FROM
Users
WHERE
User_ID = :User_ID
END_BLOCK;

		$prep_arr = array(
			':User_ID' => (int)$gachaCnt
		);

		// 親クラスのselect_query()メンバ関数を呼ぶ
		$this->select_query(
			$debug,         // デバッグ表示するかどうか
			$query,         // プレースホルダつきSQL
			$prep_arr       // データの配列
		);

		if ($row = $this->fetch_assoc()) {
			//取得したパスを返す
			return $row;
		} else {
			return null;
		}
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


//--------------------------------------------------------------------------------------
///	スタンプラリークラス
//--------------------------------------------------------------------------------------
class cstamp extends crecord
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
@brief  idを取得する
@param[in]  $debug  デバッグ出力をするかどうか
@param[in]  $id　ユーザーID
@return 個数
*/
	//--------------------------------------------------------------------------------------
	public function get_tgt($debug, $id)
	{
		if (!cutil::is_number($id) || $id < 1) {
			// falseを返す
			return false;
		}

		// プレースホルダつき
		$query = <<<END_BLOCK
SELECT
TD_ID,
Pass_Conf
FROM
StampRally
WHERE
User_ID = :User_ID
END_BLOCK;

		$prep_arr = array(
			':User_ID' => (int)$id
		);

		// 親クラスのselect_query()メンバ関数を呼ぶ
		$this->select_query(
			$debug,         // デバッグ表示するかどうか
			$query,         // プレースホルダつきSQL
			$prep_arr       // データの配列
		);

		if ($row = $this->fetch_assoc()) {
			//取得したパスを返す
			return $row;
		} else {
			return null;
		}
	}

	//--------------------------------------------------------------------------------------
	/*!
@brief  ルートを取得する
@param[in]  $debug  デバッグ出力をするかどうか
@param[in]  $id ルートID
@return 個数
*/
	//--------------------------------------------------------------------------------------
	public function get_pass($debug, $id)
	{
		// プレースホルダつきSQLクエリ
		$query = <<<END_BLOCK
SELECT
	Route_ID,
	Route_Name,
    Route_Image,
    Route_Pass
FROM
    Route
WHERE
    Route_ID = :Route_ID
END_BLOCK;

		$prep_arr = array(
			':Route_ID' => (int)$id
		);

		// 親クラスのselect_query()メンバ関数を呼ぶ
		$this->select_query(
			$debug,         // デバッグ表示するかどうか
			$query,         // プレースホルダつきSQL
			$prep_arr       // データの配列
		);
		if ($row = $this->fetch_assoc()) {
			//取得したパスを返す
			return $row;
		} else {
			return null;
		}
	}



	//--------------------------------------------------------------------------------------
	/*!
@brief  指定されたTD_IDに基づいてRoute_IDとRoute_NameとRoute_Imageを取得する
@param[in]  $debug  デバッグ出力をするかどうか
@param[in]  $td_id  TD_ID
@return 取得した結果の配列
*/
	//--------------------------------------------------------------------------------------
	public function get_all($debug, $td_id)
	{
		$arr = array();

		// プレースホルダつきSQLクエリ
		$query = <<<END_BLOCK
SELECT
	Route_ID,
    Route_Name,
    Route_Image,
    TD_ID
FROM
    Route
WHERE
    TD_ID = :TD_ID
END_BLOCK;

		$prep_arr = array(
			':TD_ID' => (int)$td_id
		);

		// 親クラスのselect_query()メンバ関数を呼ぶ
		$this->select_query(
			$debug,         // デバッグ表示するかどうか
			$query,         // プレースホルダつきSQL
			$prep_arr       // データの配列
		);

		// 順次取り出す
		while ($row = $this->fetch_assoc()) {
			$arr[] = array(
				'Route_ID' => $row['Route_ID'],
				'Route_Name' => $row['Route_Name'],
				'Route_Image' => $row['Route_Image']
			);
		}

		// 取得した配列を返す
		return $arr;
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

//--------------------------------------------------------------------------------------
///	ユーザークラス
//--------------------------------------------------------------------------------------
class cuser extends crecord
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
	@brief	すべての配列を得る
	@param[in]	$debug	デバッグ出力をするかどうか
	@return	配列（2次元配列になる）
	*/
	//--------------------------------------------------------------------------------------
	public function get_all($debug)
	{
		$arr = array();
		//プレースホルダつき
		$query = <<< END_BLOCK
select
Users.*
from
Users
where
1
order by
Admins.Admin_ID asc
END_BLOCK;
		//空のデータ
		$prep_arr = array();
		//親クラスのselect_query()メンバ関数を呼ぶ
		$this->select_query(
			$debug,			//デバッグ表示するかどうか
			$query,			//プレースホルダつきSQL
			$prep_arr		//データの配列
		);
		//順次取り出す
		while ($row = $this->fetch_assoc()) {
			$arr[] = $row;
		}
		//取得した配列を返す
		return $arr;
	}

	//--------------------------------------------------------------------------------------
	/*!
	@brief	指定されたIDの配列を得る
	@param[in]	$debug	デバッグ出力をするかどうか
	@param[in]	$id		ID
	@return	配列（1次元配列になる）空の場合はfalse
	*/
	//--------------------------------------------------------------------------------------
	public function get_tgt($debug, $id)
	{
		if (!cutil::is_number($id)) {
			// falseを返す
			return false;
		}

		// プレースホルダつき
		$query = <<<END_BLOCK
select
Users.*
from
Users
where
User_ID   = :User_ID  
END_BLOCK;
		$prep_arr = array(
			':User_ID ' => (int)$id
		);
		//親クラスのselect_query()メンバ関数を呼ぶ
		$this->select_query(
			$debug,			//デバッグ表示するかどうか
			$query,			//プレースホルダつきSQL
			$prep_arr		//データの配列
		);
		return $this->fetch_assoc();
	}

	//--------------------------------------------------------------------------------------
	/*!
	@brief	指定されたIDの更新
	@param[in]	$id					NAME
	@param[in]	$name				PASSWORD
	@param[in]	$hashed_password	HASHED_PASSWORD
	@return	配列（1次元配列になる）空の場合はfalse
	*/
	//--------------------------------------------------------------------------------------
	public function update_admin($id, $name, $hashed_password)
	{
		$dataarr = array(
			'Admin_Name' => $name,
			'Admin_PassWord' => $hashed_password
		);
		$where = 'User_ID  = :User_ID ';
		$prep_arr = array(':User_ID ' => $id);
		return $this->update_core(false, 'Admins', $dataarr, $where, $prep_arr);
	}

	//--------------------------------------------------------------------------------------
	/*!
	@brief	指定されたログインIDの配列を得る
	@param[in]	$debug	デバッグ出力をするかどうか
	@param[in]	$loginid		ログインID
	@return	配列（1次元配列になる）空の場合はfalse
	*/
	//--------------------------------------------------------------------------------------
	public function get_tgt_login($debug, $loginid)
	{
		if ($loginid == '') {
			//falseを返す
			return false;
		}
		//プレースホルダつき
		$query = <<< END_BLOCK
select
Users.*
from
Users
where
User_MailAddress = :User_MailAddress
END_BLOCK;
		$prep_arr = array(
			':User_MailAddress' => (string)$loginid
		);
		//親クラスのselect_query()メンバ関数を呼ぶ
		$this->select_query(
			$debug,			//デバッグ表示するかどうか
			$query,			//プレースホルダつきSQL
			$prep_arr		//データの配列
		);
		return $this->fetch_assoc();
	}

	//--------------------------------------------------------------------------------------
	/*!
	@brief	ユーザーの作成
	@param[in]	$username　ユーザーネーム
	@param[in]	$password パスワード
	@return	insert[Users] DBに挿入
	*/
	//--------------------------------------------------------------------------------------
	public function create_user($username, $email, $password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $dataarr = array(
            'User_Name' => $username,
            'User_MailAddress' => $email,
            'User_PassWord' => $hashed_password
        );
        return $this->insert_core(false, 'Users', $dataarr, false);
    }
	//--------------------------------------------------------------------------------------
	/*!
	@brief	ユーザーの削除
	@param[in]	$id　ユーザーID
	@return	insert[Users] DBに挿入
	*/
	//--------------------------------------------------------------------------------------
	public function delete_admin($id)
	{
		$where = 'Admin_ID = :Admin_ID';
		$prep_arr = array(':Admin_ID' => $id);
		return $this->delete_core(false, 'Users', $where, $prep_arr);
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	メールアドレスの重複チェック
	@param[in]	$email　ユーザーネーム
	@return	row[count] 重複の数を返す
	*/
	//--------------------------------------------------------------------------------------
	public function is_email_taken($email) {
		$query = <<< END_BLOCK
select
count(*)
from
Users
where
User_MailAddress = :User_MailAddress
END_BLOCK;
		$prep_arr = array(':User_MailAddress' => $email);
		$this->select_query(false, $query, $prep_arr);
		$row = $this->fetch_assoc();
		return $row['count(*)'] > 0;
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

//--------------------------------------------------------------------------------------
///	管理者クラス
//--------------------------------------------------------------------------------------
class cadmin extends crecord
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
	@brief	すべての配列を得る
	@param[in]	$debug	デバッグ出力をするかどうか
	@return	配列（2次元配列になる）
	*/
	//--------------------------------------------------------------------------------------
	public function get_all($debug)
	{
		$arr = array();
		//プレースホルダつき
		$query = <<< END_BLOCK
select
Admins.*
from
Admins
where
1
order by
Admins.Admin_ID asc
END_BLOCK;
		//空のデータ
		$prep_arr = array();
		//親クラスのselect_query()メンバ関数を呼ぶ
		$this->select_query(
			$debug,			//デバッグ表示するかどうか
			$query,			//プレースホルダつきSQL
			$prep_arr		//データの配列
		);
		//順次取り出す
		while ($row = $this->fetch_assoc()) {
			$arr[] = $row;
		}
		//取得した配列を返す
		return $arr;
	}

	//--------------------------------------------------------------------------------------
	/*!
	@brief	指定されたIDの配列を得る
	@param[in]	$debug	デバッグ出力をするかどうか
	@param[in]	$id		ID
	@return	配列（1次元配列になる）空の場合はfalse
	*/
	//--------------------------------------------------------------------------------------
	public function get_tgt($debug, $id)
	{
		if (!cutil::is_number($id)) {
			// falseを返す
			return false;
		}

		// プレースホルダつき
		$query = <<<END_BLOCK
select
Admins.*
from
Admins
where
Admin_ID  = :Admin_ID 
END_BLOCK;
		$prep_arr = array(
			':Admin_ID' => (int)$id
		);
		//親クラスのselect_query()メンバ関数を呼ぶ
		$this->select_query(
			$debug,			//デバッグ表示するかどうか
			$query,			//プレースホルダつきSQL
			$prep_arr		//データの配列
		);
		return $this->fetch_assoc();
	}

	//--------------------------------------------------------------------------------------
	/*!
	@brief	指定されたIDの更新
	@param[in]	$id					NAME
	@param[in]	$name				PASSWORD
	@param[in]	$hashed_password	HASHED_PASSWORD
	@return	配列（1次元配列になる）空の場合はfalse
	*/
	//--------------------------------------------------------------------------------------
	public function update_admin($id, $name, $hashed_password)
	{
		$dataarr = array(
			'Admin_Name' => $name,
			'Admin_PassWord' => $hashed_password
		);
		$where = 'Admin_ID = :Admin_ID';
		$prep_arr = array(':Admin_ID' => $id);
		return $this->update_core(false, 'Admins', $dataarr, $where, $prep_arr);
	}

	//--------------------------------------------------------------------------------------
	/*!
	@brief	指定されたログインIDの配列を得る
	@param[in]	$debug	デバッグ出力をするかどうか
	@param[in]	$loginid		ログインID
	@return	配列（1次元配列になる）空の場合はfalse
	*/
	//--------------------------------------------------------------------------------------
	public function get_tgt_login($debug, $loginid)
	{
		if ($loginid == '') {
			//falseを返す
			return false;
		}
		//プレースホルダつき
		$query = <<< END_BLOCK
select
Admins.*
from
Admins
where
Admin_Name = :Admin_Name
END_BLOCK;
		$prep_arr = array(
			':Admin_Name' => (string)$loginid
		);
		//親クラスのselect_query()メンバ関数を呼ぶ
		$this->select_query(
			$debug,			//デバッグ表示するかどうか
			$query,			//プレースホルダつきSQL
			$prep_arr		//データの配列
		);
		return $this->fetch_assoc();
	}

	//--------------------------------------------------------------------------------------
	/*!
	@brief	ユーザーの作成
	@param[in]	$username　ユーザーネーム
	@param[in]	$password パスワード
	@return	insert[admins] DBに挿入
	*/
	//--------------------------------------------------------------------------------------
	public function create_user($username, $password)
	{
		$hashed_password = password_hash($password, PASSWORD_DEFAULT);
		$dataarr = array(
			'Admin_Name' => $username,
			'Admin_PassWord' => $hashed_password
		);
		return $this->insert_core(false, 'Admins', $dataarr, false);
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	ユーザーの削除
	@param[in]	$id　ユーザーID
	@return	insert[admins] DBに挿入
	*/
	//--------------------------------------------------------------------------------------
	public function delete_admin($id)
	{
		$where = 'Admin_ID = :Admin_ID';
		$prep_arr = array(':Admin_ID' => $id);
		return $this->delete_core(false, 'Admins', $where, $prep_arr);
	}
	//--------------------------------------------------------------------------------------
	/*!
	@brief	ユーザーネームの重複チェック
	@param[in]	$username　ユーザーネーム
	@return	row[count] 重複の数を返す
	*/
	//--------------------------------------------------------------------------------------
	public function is_username_taken($username)
	{
		$query = <<< END_BLOCK
select
count(*)
from
Admins
where
Admin_Name = :Admin_Name
END_BLOCK;
		$prep_arr = array(':Admin_Name' => $username);
		$this->select_query(false, $query, $prep_arr);
		$row = $this->fetch_assoc();
		return $row['count(*)'] > 0;
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
