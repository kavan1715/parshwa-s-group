<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #EEEDED;
        }

        .side {
            display: flex;
            justify-content: space-between;
        }

        nav {
            display: flex;
            align-items: center;
            gap: 50px;
        }

        h1 {
            font-family: sans-serif;
            font-weight: bold;
            text-align: center;
        }

        img {
            display: block;
            margin-right: auto;
        }

        nav ul {
            display: flex;
            gap: 20px;
            list-style-type: none;
        }

        /* Add this style to the existing CSS code */
        header {
            padding: 8px 8px;
            background-color: #00224D;
            display: flex;
            flex-direction: column;
        }

        header p {
            margin: 0;
            font-family: sans-serif;
        }

        li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 18px;
        }

        li a:hover {
            background-color: rgb(32, 64, 105);
        }

        .flip-card-container {
            display: flex;
            justify-content: flex-start;
            padding: 20px;
        }

        .flip-card {
            background-color: transparent;
            width: 300px;
            height: 300px;
            perspective: 1000px;
        }

        .flip-card-inner {
            position: relative;
            width: 100%;
            height: 100%;
            text-align: center;
            transition: transform 0.6s;
            transform-style: preserve-3d;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        }

        .flip-card:hover .flip-card-inner {
            transform: rotateY(180deg);
        }

        .flip-card-front,
        .flip-card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
        }

        .flip-card-front {
            background-color: #bbb;
            color: black;
        }

        .flip-card-back {
            background-color: rgb(131, 168, 218) ;
            color: white;
            transform: rotateY(180deg);
        }
    </style>
</head>

<body>
    <header>
        <div class="side">
            <div>
                <img src="logo.png" width="70px" height="70px">
                <p style="font-size: 15px; color: white; text-align: center; margin-top: 5px;">Library Management System</p>
            </div>
            <nav>
                <ul>
                    <li><a href="Home.php">Home</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <br><br>

   <!-- <img src="lib3.gif" width="30%" height="50%"> -->

    <!-- Flip card container -->
    <div class="flip-card-container">
        <!-- Flip card -->
        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front">
                    <img src="about1.png" alt="Avatar" style="width:300px;height:300px;">
                </div>
                <div class="flip-card-back">
                    <p>Architect & Engineer</p>
                    <p>We love that guy</p>
                </div>
            </div>
        </div>
        <!-- Flip card over -->
    </div>
</body>
</html>
