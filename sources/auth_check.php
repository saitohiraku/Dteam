<?php
/*!
@file auth_check.php
@brief ログインチェックファイル
@details このファイルをインクルードすることで、ログインしていない場合にログインページにリダイレクトする
*/

// セッションを開始
session_start();


// ユーザーがログインしていない場合、ログインページにリダイレクト
if (!isset($_SESSION['tmD2024_use']['User_ID'])) {
    header("Location: ./login.php");
    exit();
}

?>
