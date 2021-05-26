<script>
        $(document).ready(function() {
        $('a.Btn').click( function(event){
            event.preventDefault();
            $('#myOverlay').fadeIn(297,	function(){
            $('#myModal') 
            .css('display', 'block')
            .animate({opacity: 1}, 198);
            });
        });
        
        $('#myModal__close, #myOverlay').click( function(){
            $('#myModal').animate({opacity: 0}, 198, function(){
            $(this).css('display', 'none');
            $('#myOverlay').fadeOut(297);
            });
        });
        });
    </script>

<div class="BlockInfo">
    <div class="Content">
        <div class="Project">
            <div class="TextBlock">
                <p class="Topic">Игра Змейка</p>
                <p>
                    &nbsp;&nbsp;&nbsp;&nbsp;Игра "Змейка" - нестареющая классика.
                    Вы должны управлять длинным тонким существом, напоминающим змею, 
                    которое ползает по плоскости (как правило, ограниченной стенками), 
                    собирая еду (или другие предметы), избегая столкновения с собственным
                        хвостом и краями игрового поля.
                </p>
                <p>Плюсы:</p>
                <ul>
                    <li>Работает</li>
                    <li>Прикольно, весело</li>
                    <li>Классика</li>
                </ul>
                <p>Минусы:</p>
                <ul>
                    <li>Да какие минусы, это змейка</li>
                </ul>
                <a class="Btn" id="tryBtn" href="#">Попробовать</a>
                <script>
                tryBtn = document.getElementById("tryBtn");

                tryBtn.onclick = function() {
                resumeGame();
                }
                </script>
            </div>
            <img src="imgs/snake_game.png" />
        </div>
    </div>
</div>


<div class="BlockInfo">
    <div class="Content">
        <div class="Project">
            <div class="TextBlock">
                <p class="Topic">Discord music bot</p>
                <p>
                    &nbsp;&nbsp;&nbsp;&nbsp;Leviy Botinok - совершенно
                    бесплатный в использовании музыкальный бот для
                    Discord. Как и другие, он обеспечивает
                    высококачественное воспроизведение музыки, которую
                    можно извлечь из YouTube. Вы можете использовать
                    либо автоматический поиск, либо ручной поиск, чтобы
                    найти нужную музыку. 
                </p>
                <p>Плюсы:</p>
                <ul>
                    <li>Работает</li>
                    <li>Ручной/Автоматический поиск трека</li>
                    <li>Просмотр очереди воспроизведения</li>
                </ul>
                <p>Минусы:</p>
                <ul>
                    <li>Не обнаружено</li>
                </ul>
            </div>
            <img src="imgs/discord_music_bot.png" />
        </div>
    </div>
</div>
    
<div class="BlockInfo">
    <div class="Content">
        <div class="Project">
            <img src="imgs/song_recogniser.png" />
            <div class="TextBlock">
                <p class="Topic">Song Recogniser</p>
                <p>
                    &nbsp;&nbsp;&nbsp;&nbsp;Единственное в своем роде
                    десктопное приложение для распознавания музыки.
                    Прослушивание этой самой музыки можно вести с
                    помощью микрофона или прямиком из системы (используя
                    loopback мод windows). 
                </p>
                <p>Плюсы:</p>
                <ul>
                    <li>Работает</li>
                    <li>Доступен выбор источника звука</li>
                </ul>
                <p>Минусы:</p>
                <ul>
                    <li>Приложение привязано к системе Windows</li>
                </ul>
            </div>
        </div>
    </div>
</div>