<div id="frame">
    <!--HEADER-->
    <div id="headerleft" onclick="window.location.href='mainpage.php';">
        <!--bal oldali kek dolog-->
        <img src="magyarkonyha.png">
        <p>AMITOL A SZELLEM IS JOLLAKIK</p>
    </div>
        <?php
            // check if user is logged in and has common or admin user_type
            if (isset($_SESSION['user_type']) && ($_SESSION['user_type'] == 'common' || $_SESSION['user_type'] == 'admin')) {
                // if user is logged in and has common or admin user_type, hide the div using CSS
                echo '<style>#headerright { display: none; }</style>';
            }
        ?>
        <div id="headerright">
            <!--profil-->
            <img src="user.png" id="userimage">
            Profil/bejelentkezes
            <form action="urlap.aspx" method="post">
                <input class="login" type="text" placeholder="Felhasznalonev"></br>
            <form action="urlap.aspx" method="post">
                <input class="login" type="text" placeholder="Jelszo"></br>
            <button id="loginbutton" type="submit">Bejelentkezes</button>
        </div>

    <div id="menubox">
        <a class="custom-button" href=newrecipe.php>Recept feltoltes</a>
    </div>
</div>
