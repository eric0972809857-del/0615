<?php
    // 關閉錯誤顯示（避免錯誤訊息直接顯示在畫面上）
    error_reporting(0);

    // 啟用 Session（用來記錄登入狀態）
    session_start();

    // 判斷是否有登入（檢查 Session 裡是否有 id）
    if (!$_SESSION["id"]) {

        // 未登入時顯示提示訊息
        echo "請登入帳號";

        // 3秒後自動跳轉到登入頁面
        echo "<meta http-equiv=REFRESH content='3, url=2.login.html'>";
    }
    else{

        // ================= 資料庫連線 =================
        // 連接 MySQL 資料庫（主機、帳號、密碼、資料庫）
        $conn = mysqli_connect("120.105.96.90", "immust", "immustimmust", "immust");

        // ================= SQL 刪除指令 =================
        // 從網址 GET 取得 bid（佈告編號）
        // 並刪除該筆資料
        $sql = "DELETE FROM bulletin WHERE bid='{$_GET["bid"]}'";

        // （除錯用）印出 SQL 語法
        // echo $sql;

        // ================= 執行 SQL =================
        if (!mysqli_query($conn, $sql)) {

            // 刪除失敗
            echo "佈告刪除錯誤";

        } else {

            // 刪除成功
            echo "佈告刪除成功";
        }

        // ================= 跳轉回佈告欄 =================
        // 3秒後回到佈告欄頁面
        echo "<meta http-equiv=REFRESH content='3, url=11.bulletin.php'>";
    }
?>
