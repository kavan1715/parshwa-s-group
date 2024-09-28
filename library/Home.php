<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Website</title> 
   <style>
    
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family:sans-serif;
}
::selection{
  color: #000;
  background: #fff;
}
.side{
    display: flex;
    justify-content: space-between;
}
nav{
    display: flex;
    align-items: center;
    gap: 50px;
}

img{
    display: block;
    margin-right: auto;

  }
nav ul{
    display: flex;
    gap :20px;
    list-style-type: none;
}

/* Add this style to the existing CSS code */
header {
    padding: 8px 8px;
    background-color: #000A39;
    display: flex;
    flex-direction: column;
}

header p {
    margin: 0;
    font-family: sans-serif;
}

li a{
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size:18px;
    font-family:sans-serif;
}
li a:hover{
    background-color:rgb(32, 64, 105);
}
.img{
  background: url('back.jpeg')no-repeat;
  width: 100%;
  height: 100vh;
  background-size: cover;
  background-position: center;
  position: relative;
}
.img::before{
  content: '';
  position: absolute;
  height: 100%;
  width: 100%;
  background: rgba(0, 0, 0, 0.4);
}

.center{
  position: absolute;
  top: 52%;
  left: 50%;
  transform: translate(-50%, -40%);
  width: 100%;
  padding: 0 20px;
  text-align: center;
}
.center .title{
  color: white;
  font-size: 55px;
  font-weight: 700;
}
.style-word {
  font-family: Times New Roman;
  font-size: 90px; 
  color:#ed6ea7;

}
.center .sub_title{
  color: white;
  font-size: 52px;
  font-weight: 500;
}
.center .btns{
  margin-top: 20px;
}
.center .btns button{
  height: 55px;
  width: 170px;
  border-radius: 5px;
  border: none;
  margin: 0 10px;
  border: 2px solid white;
  font-size: 20px;
  font-weight: 500;
  padding: 0 10px;
  cursor: pointer;
  outline: none;
  transition: all 0.3s ease;
}
.center .btns button:first-child{
  color: #fff;
  background: none;
}
.btns button:first-child:hover{
  background: white;
  color: black;
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
                <li><a href="about.php">Aboutus</a></li>
            </ul>
            </nav>
        </div>
        </header>

  <div class="img"></div>
  <div class="center">
    <div class="title">Weclome to <span class="style-word">Library Management</span></div>
    <div class="sub_title">SYSTEM!</div>
    <div class="btns">
        <a href="/library/Admin/adminlogin.php"><button>Admin</button></a>
        <a href="/library/Admin/Student/stulogin.php"><button>Student</button></a>
      
    </div>  
  </div>
</body>
</html>