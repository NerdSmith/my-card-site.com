<?php
require_once "connect_db.php";


include("class.php");
mysqli_close($link);
?>
<!DOCTYPE html>
<html>
	<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name=viewport content="width=device-width, initial-scale=1"> 
  <link rel="stylesheet" href="style.css" />
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link
    href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap"
    rel="stylesheet"
  />
  <link rel="shortcut icon" href="/imgs/logo.svg" type="image/x-icon" />
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link
    href="https://fonts.googleapis.com/css2?family=Oswald:wght@700&display=swap"
    rel="stylesheet"
  />
  <script src="JS\jquery-3.6.0.min.js"></script>
  <script src="document.js"></script>
  <script>
    let lastVisit;
    let date;
    let tryBtn;
  </script>

	<title><?php echo $data->title(); ?></title>
	</head>

	<body>
		<header>
      <?php echo $data->menu(); ?>
		</header>
		<div class="TopIndent"></div>
</head>

<div id="myOverlay"></div>
<div id="myModal">
    <canvas class="display" id="display"></canvas>
    <p><label>Snake length:</label>  <span id="snakeLength"></span></p>
    <p><label>Game speed:</label>  <span id="gameSpeed"></span></p>
    <p>W/A/S/D - movement</p>
    <button class="Btn" id="startGame">Start new game</button>
    <span id="myModal__close" class="close">ₓ</span>
    <script src="JS\snake_game.js"></script>
    <script>
        function statRender() {  
        document.getElementById('snakeLength').innerHTML = snake.sections.length;
        document.getElementById('gameSpeed').innerHTML = gameSpeed;
        }

        async function main() {
        let viewPort = document.getElementById('display');
        let startButton = document.getElementById('startGame');
        
        startButton.onclick = function() {
            initGame(viewPort);
            startGame(statRender);
        }
        
        let overlay = document.getElementById('myOverlay');
        let modal_close = document.getElementById('myModal__close');
        
        overlay.onclick = function() {
            pauseGame();
        }
        modal_close.onclick = function() {
            pauseGame();
        }
        }
        main();
  </script>
</div>

<div id="myModal2">
<span id="myModal__close" class="close">ₓ</span>
  <script>
        $(document).ready(function() {
        $('a.add_btn').click( function(event){
            event.preventDefault();
            $('#myOverlay').fadeIn(297,	function(){
            $('#myModal2') 
            .css('display', 'block')
            .animate({opacity: 1}, 198);
            });
        });
        
        $('#myModal__close, #myOverlay').click( function(){
            $('#myModal2').animate({opacity: 0}, 198, function(){
            $(this).css('display', 'none');
            $('#myOverlay').fadeOut(297);
            });
        });
        });
  </script>
<p>Добавить комментарий</p>
<p>Имя:</p>
<input id='name_input' name="name_input" type="text" name="key" placeholder="Введите имя"></input>
<p>Комментарий:</p>
<textarea id='comment_input' name="comment_input" style="resize: none;" rows="15" cols="40"></textarea>
<input class="submit_btn" id="submit_btn" type="button" name="print" value="Подтвердить" />
<script>
 $("#submit_btn").click(function() {
 
 var name_input = $("#name_input").val();
 var comment_input = $("#comment_input").val();
 
 if(name_input==''||comment_input=='') {
 alert("Please fill all fields.");
 return false;
 }

 $.ajax({
 type: "POST",
 url: "add_to_db.php",
 data: {
  name_input: name_input,
  comment_input: comment_input
 },
 cache: false,
 success: function(data) {
 $("#comment_input").val("");
 $("#name_input").val("");
 alert("Thank you!");
 },
 error: function(xhr, status, error) {
 console.error(xhr);
 }
 });
 });
 </script>
</div>

<div class="cnt">
  <?php echo $data->content($data->state(),$data->title()); ?>
</div>
<a class="add_btn" id="add_btn"><img src="imgs\Plus.png"></img></a>

		<div class="BotIndent"></div>
		<footer class="footer">
			<div class="Content">
				<p>
					Все, что есть на этом сайте - принадлежит мне. И даже не
					думай, что-либо тырить отсюда, ведь у меня есть твой ip.
					<br />
					Это в интернете ты такой смелый, а вот в реальности мы
					посмотрим, как ты запоешь, если я узнаю, что ты украл что-то
					с этого сайта.
				</p>
			</div>
		</footer>
	</body>
</html>
