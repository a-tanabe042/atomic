export const AnswerDataHTML = `
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>学習アプリ</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .header {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            text-align: center;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header .logo {
            font-size: 24px;
        }

        .menu-toggle {
            display: block;
            /* この行を変更 */
            cursor: pointer;
        }

        .menu-toggle .bar {
            display: block;
            width: 25px;
            height: 3px;
            margin: 5px auto;
            background-color: white;
        }

        .container {
            max-width: 100%;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        button {
            padding: 10px 20px;
            background-color: #008CBA;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #005f73;
        }

        .footer {
            background-color: #333;
            color: white;
            text-align: center;
            margin-top: 100px;
            padding: 40px 0;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        .menu-content {
            display: none;
            background-color: white;
            position: absolute;
            top: 60px;
            /* ヘッダーの高さに合わせて調整 */
            right: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 10px;
        }

        .menu-content a {
            display: block;
            color: #333;
            padding: 5px 10px;
            text-decoration: none;
        }

        .menu-content a:hover {
            background-color: #f4f4f4;
        }

        .logo img {
            width: 100px;
            /* ロゴのサイズ調整 */
        }

        .main-image {
            text-align: center;
            margin-top: 20px;
        }

        .main-image img {
            max-width: 100%;
            height: auto;
        }

        .cards {
            display: flex;
            justify-content: center;
            margin: 10px;
        }

        .card {
            flex-basis: auto;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
            padding: 10px;
            margin: 5px;
            max-width: 100%;
        }

        .card img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .card h3 {
            margin-top: 15px;
        }
    </style>
</head>

<body>
    <div id="top" class="header">
        <div class="logo">
            <img src="https://via.placeholder.com/100x50.png?text=Logo" alt="ロゴ">
        </div>
        <div class="menu-toggle" onclick="toggleMenu()">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
        <div class="menu-content" id="menuContent">
            <a href="#top">ホーム</a>
            <a href="#main">機能</a>
            <a href="#contact">お問い合わせ</a>
        </div>
    </div>

    <div id="main" class="container" >
        <div class="main-image">
            <img src="https://via.placeholder.com/600x300.png?text=Main+Image" alt="メイン画像">
        </div>
        <h1>ようこそ、学習アプリへ！</h1>
        <button onclick="showAlert()">クリックしてね</button>
    </div>
    <div class="cards">
        <div class="card">
            <img src="https://via.placeholder.com/200x150.png?text=Card+1" alt="Card 1">
            <h3>カード 1</h3>
            <p>カードの説明 1</p>
        </div>
        <div class="card">
            <img src="https://via.placeholder.com/200x150.png?text=Card+2" alt="Card 2">
            <h3>カード 2</h3>
            <p>カードの説明 2</p>
        </div>
        <div class="card">
            <img src="https://via.placeholder.com/200x150.png?text=Card+3" alt="Card 3">
            <h3>カード 3</h3>
            <p>カードの説明 3</p>
        </div>
    </div>


    <div id="contact"  class="footer">
        <p>&copy; 2023 学習アプリ. All rights reserved.</p>
    </div>

    <script>
        function showAlert() {
            alert('ボタンがクリックされました！');
        }

        function toggleMenu() {
            var menu = document.getElementById('menuContent');
            if (menu.style.display === 'block') {
                menu.style.display = 'none';
            } else {
                menu.style.display = 'block';
            }
        }
    </script>
</body>

</html>



`;
