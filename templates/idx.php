<div class="BlockInfo">
    <div class="Content">
        <div class="ImgWrapper">
            <img src="imgs/Paw.gif" />
        </div>
        <div>
            <p class="Topic">Привет, путник</p>
            <p class="InfoLabel1"><span id="lastVisit"></span></p>
            <p class="InfoLabel2">Скажу по секрету, но в проектах кое-что появилось)</p>
        </div>

        <div class="ImgWrapper">
            <img src="imgs/Paw.gif" />
        </div>
    </div>
</div>
<script>
    function get_cookie ( cookie_name )
    {
    var results = document.cookie.match ( '(^|;) ?' + cookie_name + '=([^;]*)(;|$)' );
    
    if ( results )
        return ( unescape ( results[2] ) );
    else
        return null;
    }
    lastVisit = get_cookie("lastvisit");
    
    date = new Date(Date.now());
    if (lastVisit == null) {

        document.getElementById('lastVisit').innerHTML = "Добро пожаловать на сайт первый раз!"
    }
    else {
        document.getElementById('lastVisit').innerHTML = "Последний визит: " + lastVisit;
    }
    document.cookie = "lastvisit=" + date.getDate() + "." + (date.getMonth() + 1) + "."
    + date.getFullYear() + " | " + date.getHours() + ":" + date.getMinutes() + "; expires=01/01/2200 00:00:00; path=/; SameSite=Lax";
</script>