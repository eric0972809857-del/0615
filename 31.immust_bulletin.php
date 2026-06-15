<!DOCTYPE html>
<html>
<head>
    <!-- 網頁標題 -->
    <title>明新科技大學資訊管理系</title>

    <!-- 設定編碼，避免中文亂碼 -->
    <meta charset="utf-8">

    <!-- 引入 Flexslider 套件（圖片輪播用） -->
    <link href="https://cdn.bootcss.com/flexslider/2.6.3/flexslider.min.css" rel="stylesheet">

    <!-- 引入 jQuery -->
    <script src="https://cdn.bootcss.com/jquery/2.2.2/jquery.min.js"></script>

    <!-- 引入 Flexslider JS -->
    <script src="https://cdn.bootcss.com/flexslider/2.6.3/jquery.flexslider-min.js"></script>        

    <script>
        // 當網頁載入完成後執行
        $(window).load(function() {
            $('.flexslider').flexslider({
                animation: "slide", // 輪播方式：滑動
                rtl: true           // 從右到左
            });
        });
    </script>

    <style>
        /* 全域設定 */
        *{
            margin:0;
            color:gray;
            text-align:center;
        }

        /* ================= 上方區塊 ================= */
        .top{
             background-color: white;
        }

        .top .container{
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding:10px;
        }

        /* LOGO */
        .top .logo{
            font-size: 35px;
            font-weight: bold;
        }

        .top .logo img{
            width: 100px;
            vertical-align: middle;
        }

        /* 右上選單 */
        .top .top-nav{
            font-size: 25px;
            font-weight: bold;       
        }

        .top .top-nav a{
            text-decoration: none;
        }

        /* ================= 導覽列 ================= */
        .nav {
            background-color:#333;
            display: flex;
            justify-content: center;
        }

        .nav ul {
            list-style-type: none;  
            margin: 0; 
            padding: 0; 
            overflow: hidden; 
        }

        .nav li {
            float: left; 
        }

        .nav li a {    
            display: block;  
            color: white;  
            padding: 14px 16px;  
            text-decoration: none;  
        }

        .nav li a:hover {
            background-color: #111; 
        }

        /* 下拉選單 */
        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #333;
        }

        /* ================= 輪播 ================= */
        .slider{
            background-color: black;
        }

        /* ================= 佈告欄 ================= */
        .bulletin{
            background-color: rgb(255,204,153);
            padding: 30px 0;
        }

        .bulletin table{
            border-collapse:collapse;
            font-size:16px; 
            border:1px solid #000;
        }

        .bulletin table th{
            background-color: #abdcff;
            color: #ffffff;
        }

        .bulletin table td{
            background-color: #ffffff;
            color: #0396ff;
        }

    </style>
</head>

<body>

<!-- ================= 頁首 ================= -->
<div class="top">
    <div class="container">

        <!-- LOGO -->
        <div class="logo">
            <img src="https://github.com/shhuangmust/html/raw/111-1/IMMUST_LOGO.JPG">
            明新科技大學資訊管理系
        </div>

        <!-- 右上選單 -->
        <div class="top-nav">
            <a href=>明新科大</a>
            <a href=>明新管理學院</a>

            <!-- 點擊顯示登入視窗 -->
            <label onclick="document.getElementById('login').style.display='block'">登入</label>

            <!-- 登入視窗 -->
            <div id="login" class="modal">
                <span onclick="document.getElementById('login').style.display='none'">
                    &times; 管理系統登入
                </span>

                <!-- 表單送到 login.php -->
                <form method=post action="10.login.php">
                    帳號：<input type=text name="id"><br />
                    密碼：<input type=password name="pwd"><p></p>
                    <input type=submit value="登入">
                    <input type=reset value="清除">
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ================= 導覽列 ================= -->
<div class="nav">   
    <ul>
        <li><a href="#home">首頁</a></li>
        <li><a href="#introduction">系所簡介</a></li>

        <!-- 下拉選單 -->
        <li class="dropdown">
            <a href="#faculty">成員簡介</a>
            <div class="dropdown-content">
                <a href="#">黃老師</a>
                <a href="#">李老師</a>
                <a href="#">應老師</a>
            </div>                       
        </li>

        <li><a href="#about">相關資訊</a></li>
    </ul>
</div>

<!-- ================= 輪播圖片 ================= -->
<div class="slider">
    <div class="flexslider">
        <ul class="slides">
            <li><img src="slider1.JPG" /></li>
            <li><img src="slider2.JPG" /></li>
            <li><img src="slider3.JPG" /></li>
        </ul>
    </div>
</div>

<!-- ================= 佈告欄 ================= -->
<div class="bulletin">
   <h1>最新公告</h1>

    <?php
        // 1. 連接資料庫
        $conn = mysqli_connect("120.105.96.90", "immust", "immustimmust", "immust");

        // 2. 查詢 bulletin 表
        $result = mysqli_query($conn, "SELECT * FROM bulletin");

        // 3. 建立表格標題
        echo "<table border=2>
                <tr>
                    <th>佈告編號</th>
                    <th>佈告類別</th>
                    <th>標題</th>
                    <th>佈告內容</th>
                    <th>發佈時間</th>
                </tr>";

        // 4. 逐筆讀取資料
        while ($row = mysqli_fetch_array($result)) {

            echo "<tr>";

            // 顯示編號
            echo "<td>" . $row["bid"] . "</td>";

            // 類型轉換
            echo "<td>";
            if ($row["type"] == 1) echo "系上公告";
            if ($row["type"] == 2) echo "獲獎資訊";
            if ($row["type"] == 3) echo "徵才資訊";
            echo "</td>";

            // 顯示內容
            echo "<td>" . $row["title"] . "</td>";
            echo "<td>" . $row["content"] . "</td>";
            echo "<td>" . $row["time"] . "</td>";

            echo "</tr>";
        }

        // 結束表格
        echo "</table>";
    ?>
</div>

<!-- ================= 頁尾 ================= -->
<div class="footer">
    &copy; Copyright 2022 MUST
</div>

</body>
</html>
