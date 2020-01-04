<?php
/**
 * JWT認証トークン取得
 */

require_once 'messenger/init.php';
require_once 'lib/jwt/init_jwt.php';

//========================
// データ取得
//========================

$uniqueId = filter_input(INPUT_POST, 'uid');
$password = filter_input(INPUT_POST, 'pw');


//========================
// ログイン
//========================

$member = new Member($db, $uniqueId, $password);
$status = $member->memberId > 0 ? Response::SUCCESS : Response::BAD_REQUEST;


//========================
// レスポンス出力
//========================

$response = array('status' => $status);
if ($status == Response::SUCCESS) {
	$response['token'] = $jwt;
}

Response::exitWithCode(Response::SUCCESS, json_encode($response));