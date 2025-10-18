<!DOCTYPE html>
<html>

<head>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <style>
        header * {
            user-select: none;
        }
        header {
            position: sticky;
            top: 0;
            left: 0;
            z-index: 1000;
            border-bottom: 1px solid var(--line-color);
            padding: 10px 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: nowrap;
            width: 100%;
            transition: background-color .3s;
            height: 105px;
            background-color: rgb(15, 15, 15, 0);
        }
        .opacity-header {
            background-color: rgb(15, 15, 15, .6);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
        }
        
        header>div {
            width: var(--max-width);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        header .headerLeft {
            align-items: center;
            display: flex;
            gap: 35px;
            color: var(--text-color);
            transition: .3s;
        }

        header .headerLeft .toggleMenu {
            font-size: 1.4em;
            cursor: pointer;
            color: var(--text-color);
            display: none;
            color: var(--text-color);
        }

        header .logo {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        header .logo>a {
            display: flex;
            align-items: center;
            height: 60px !important;
            margin: -15px;
            padding-inline: 15px;
            gap: 5px;
        }

        header .logo img {
            position: relative;
            z-index: 2;
            height: 50px;
            border-radius: 50em;
            border: 1px solid var(--line-color);
            padding: 10px;
        }

        header .title {
            font-size: 45px;
        }

        header a {
            text-decoration: none;
            color: var(--text-color);
            cursor: pointer;
            transition: .3s;
        }

        header a div {
            margin-left: 10px;
        }

        header a h2 {
            font-weight: 600;
            font-size: 1.1em;
            line-height: 23px;
            color: var(--text-color);
        }

        header a h3 {
            font-weight: 500;
            font-size: .9em;
            line-height: 23px;
            color: var(--text-color);
            opacity: .7;
        }

        header .menu-cont {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        header .search-menu {
            display: none;
        }

        header .menu {
            font-size: 1em;
            display: flex;
            align-items: center;
            flex-direction: row;
            gap: 20px;
            list-style-type: none;
        }

        header .copyright {
            display: none;
        }

        .nav .logo {
            display: none;
        }

        .hidden {
            display: none !important;
        }

        header .v-divider {
            height: 40px;
            border-left: 1px solid var(--line-color);
        }

        header .username-tag {
            display: inline-block;
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
            max-width: 150px;
        }

        .diamond a {
            display: flex;
            align-items: center;
            gap: 4px;
            font-weight: 600;
            cursor: pointer;
            color: var(--text-color);
            border-radius: 50em;
            height: auto;
            padding: 7px 10px 4px 7px;
        }
        .diamond a::after {
            border-radius: 50em;
        }
        .diamond i,
        .tool-tip > div h4 i,
        .tool-tip .points-label i {
            font-size: 1.8em !important;
            opacity: 1 !important;
            background: var(--bg-objects);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .diamond span {
            opacity: .8;
        }

        header .shadow {
            display: none;
        }

        .floating-butt {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            animation: zoom-in .3s;
        }
        @keyframes zoom-in {
            0% {
                opacity: 0;
                transform: scale(.7);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        .floating-butt a {
            height: 65px;
            width: 65px;
            border-radius: 50em;
            box-shadow: 2px 2px 6px 4px rgb(10, 10, 10, .4);
        }

        .floating-butt a i {
            font-size: 1.5em;
        }
        .floating-butt a::after {
            border-radius: 50em;
        }

        .vertical-header {
            position: fixed;
            z-index: 1000;
            width: var(--max-width);
            left: 50%;
            top: 90px;
            display: flex;
            justify-content: flex-end;
            pointer-events: none;
        }
        .tool-tip > div {
            margin-right: 210px;
            padding: 15px;
            border-radius: 10px;
            background-color: rgb(15, 15, 15, .6);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid var(--line-color);
            width: 380px;
        }
        .vertical-menu > ul {
            padding: 0 10px;
            border-radius: 10px;
            list-style-type: none;
            background-color: rgb(15, 15, 15, .6);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid var(--line-color);
        }
        .vertical-menu > ul li {
            margin: 10px 0;
        }
        .vertical-menu.show-menu * {
            pointer-events: auto;
        }
        .vertical-menu > ul .ripple > a {
            justify-content: flex-start;
            width: 100%;
            min-width: 230px;
        }
        .vertical-menu > ul .h-divider {
            width: 100%;
            border-top: 1px solid var(--line-color);
        }
        .vertical-header.show-menu,
        .vertical-more.show-menu {
            transition: .3s ease-out;
            opacity: 1;
            transform: translate(-50%, 0);
        }
        .vertical-header.hidden-menu,
        .vertical-more.hidden-menu {
            transition: .3s ease-out;
            opacity: 0;
            transform: translate(-50%, 10px);
        }

        .tool-tip > div {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .tool-tip > div h4 {
            font-weight: 600;
            font-size: 1.1em;
            display: flex;
            gap: 5px;
            justify-content: center;
            align-items: center;
        }
        .tool-tip > div p {
            opacity: .7;
        }
        .tool-tip .points-label {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: -5px;
        }
        .tool-tip .points-label > div {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 5px;
            padding-inline: 15px;
            height: 60px;
            background-color: var(--line-color);
            border-radius: 10px;
            font-size: .9em;
        }
        .tool-tip .points-label > div span:nth-child(2) {
            width: 10%;
        }
        .tool-tip .points-label > div span:nth-child(3) {
            width: 80%;
        }

        .not-read-label {
            background-color: var(--primary);
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            border-radius: 50em;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 20px;
            width: 20px;
            font-size: .9em;
        }

    </style>

</head>

<body>

    <div class="timer-alert hidden-timer">
        <i class='bx bxs-info-circle'></i>
        <span class="text"></span>
        <div class="progress"></div>
    </div>

    <?php include 'config.php'; ?>

    <?php

    if (isset($_COOKIE["login_user"])) {

        $user_id = $_COOKIE["login_user"];
        $tabella = "tbl_notifications";
        $count_notifications = 0;

        // get notifications not read

        $mysqli_notifications = new mysqli($host, $username_db, $password_db, $db_name) or die("Unable to connect");
        $mysqli_notifications->select_db($db_name) or die("Unable to select database");
        mysqli_set_charset($mysqli_notifications, "utf8");
        $query_notifications = "SELECT id FROM $tabella WHERE id_us = '" . $user_id . "' AND has_read = 0";
        if ($result_notifications = $mysqli_notifications->query($query_notifications)) {
            /* fetch associative array */
            while ($row = $result_notifications->fetch_assoc()) {
                $count_notifications++;
            }
        }

        /* free result set */
        $result_notifications->free();
        $mysqli_notifications->close();

    }

    ?>

    <header>
        <div>
            <div class="shadow shadow-inactive"></div>
            <div class="headerLeft">
                <!-- <i class="toggleMenu bx bx-menu"></i> -->
                <div class="logo">
                    <i class="toggleMenu bx bx-menu"></i>
                    <a href="<?php echo $folder ?>/index">
                        <img src="<?php echo $folder ?>/favicon.png" alt="" />
                        <div>
                        <h2>BlazeBegin</h2>
                        <h3>by Avabucks</h3>
                        </div>
                    </a>
                </div>
                <div class="nav nav-inactive">
                    <div>
                        <div class="logo">
                            <i class="toggleMenu bx bx-menu"></i>
                            <a href="<?php echo $folder ?>/index">
                                <img src="<?php echo $folder ?>/favicon.png" alt="" />
                                <div>
                                <h2>BlazeBegin</h2>
                                <h3>by Avabucks</h3>
                                </div>
                            </a>
                        </div>
                        <ul class="menu">
                            <div class="v-divider"></div>
                            <li class="lnk ripple search-menu"><a href="<?php echo $folder ?>/search"><i class='bx bx-search'></i>Search</a></li>
                            <li class="lnk ripple"><a href="<?php echo $folder ?>/explore"><i class='bx bx-collection'></i>Explore</a></li>
                            <li class="lnk ripple"><a href="<?php echo $folder ?>/trending"><i class='bx bx-bar-chart-alt-2'></i>Trending</a></li>
                            <li class="lnk ripple"><a href="<?php echo $folder ?>/topics"><i class='bx bx-category'></i>Topics</a></li>
                            <li class="lnk ripple hide-on-tablet aboutus-butt"><a href="<?php echo $folder ?>/about"><i class='bx bx-info-circle' ></i>About</a></li>
                        </ul>
                    </div>
                    <div class="copyright">
                        <p>© BlazeBegin by Avabucks</p>
                    </div>
                </div>
            </div>

            <div class="menu-cont">
                    <?php if (isset($_COOKIE["login_user"])) {

                    $user_id = $_COOKIE["login_user"];
                    $tabella = "tbl_user";

                    $mysqli_diamonds = new mysqli($host, $username_db, $password_db, $db_name) or die("Unable to connect");
                    $mysqli_diamonds->select_db($db_name) or die("Unable to select database");
                    mysqli_set_charset($mysqli_diamonds, "utf8");
                    $query_diamonds = "SELECT diamonds FROM $tabella WHERE id_us = '" . $user_id . "'";
                    if ($result_diamonds = $mysqli_diamonds->query($query_diamonds)) {
                    /* fetch associative array */
                    while ($row = $result_diamonds->fetch_assoc()) {
                        $diamonds = $row["diamonds"];
                    }

                    }

                    /* free result set */
                    $result_diamonds->free();
                    $mysqli_diamonds->close();
                    ?>
                    <div class="ripple outline diamond"><a><i class='bx bx-bolt-circle'></i><span><?php echo number_format($diamonds,0,",",".") ?></span></a></div>
                    <?php } ?>
                    <div class="v-divider"></div>
                    <div class="ripple hide-on-mobile"><a href="<?php echo $folder ?>/search"><i class='bx bx-search icon-butt search-icon'></i></a></div>
                    <?php if (isset($_COOKIE["login_user"])) { ?>
                    <div class="ripple outline vertical-menu-butt">
                        <a>
                            <i class='bx bxs-user'></i>
                            <span class="username-tag"><?php echo $_COOKIE["username"] ?></span>
                            <i class='bx bx-chevron-down'></i>
                            <?php if ($count_notifications != 0) { ?>
                                <span class="not-read-label"><?php echo $count_notifications ?></span>
                            <?php } ?>
                        </a>
                    </div>
                    <?php } else { ?>
                    <div class="ripple outline"><a href="<?php echo $folder ?>/login"><i class='bx bx-user'></i>Log In</a></div>
                    <div class="ripple primary signup-butt hide-on-tablet"><a href="<?php echo $folder ?>/signup"><i class='bx bx-user-plus'></i>Sign Up</a></div>
                    <?php } ?>
            </div>
        </div>
    </header>

    <div class="vertical-header vertical-menu hidden-menu">
        <ul>
            <li>
                <div class="ripple"><a href="<?php echo $folder ?>/submit"><i class='bx bx-plus'></i>Submit</a></div>
            </li>
            <li>
                <div class="ripple"><a href="<?php echo $folder ?>/profile/<?php echo strtolower(str_replace(" ", "-", $_COOKIE["username"])) ?>"><i class='bx bx-user'></i>Profile</a></div>
            </li>
            <li>
                <div class="ripple">
                    <a href="<?php echo $folder ?>/notifications">
                        <i class='bx bx-bell'></i>
                        Notifications
                        <?php if ($count_notifications != 0) { ?>
                            <span class="not-read-label"><?php echo $count_notifications ?></span>
                        <?php } ?>
                    </a>
                </div>
            </li>
            <li>
                <div class="ripple"><a href="<?php echo $folder ?>/dashboard"><i class='bx bx-table'></i>Dashboard</a></div>
            </li>
            <li>
                <div class="ripple"><a href="<?php echo $folder ?>/your-likes"><i class='bx bx-heart'></i>Your Likes</a></div>
            </li>
            <?php if ($admin_id == $_COOKIE["login_user"]) { ?>
                <li>
                    <div class="ripple"><a href="<?php echo $folder ?>/admin/"><i class='bx bx-key'></i>Admin</a></div>
                </li>
                <li>
                    <div class="ripple"><a href="<?php echo $folder ?>/admin/clean_up"><i class='bx bx-brush-alt'></i>Clean Images</a></div>
                </li>
            <?php } ?>
            <li>
                <div class="h-divider"></div>
            </li>
            <li>
                <div class="ripple"><a href="<?php echo $folder ?>/index?q=logout"><i class='bx bx-log-out-circle'></i>Log Out</a></div>
            </li>
        </ul>
    </div>

    <div class="vertical-header tool-tip hidden-menu">
        <div>
            <h4><i class='bx bx-bolt-circle'></i>Creator Points</h4>
            <p>Earn and redeem points for your startup which can be used to bring your startup to the forefront of the platform and gain exposure.</p>
            <p>You get:</p>
            <div class="points-label">
                <div><i class='bx bx-bolt-circle'></i><span>100</span><span>When your startup gets published.</span></div>
                <div><i class='bx bx-bolt-circle'></i><span>10</span><span>For every person that adds your startup to their favorites.</span></div>
            </div>
        </div>
    </div>

    <div class="floating-butt ripple primary add-butt"><a href="<?php echo $folder ?>/submit"><i class='bx bx-plus'></i></a></div>

    <script>
        const menus = document.querySelectorAll(".toggleMenu");
        const links = document.querySelectorAll(".lnk a");
        const nav = document.querySelector(".nav");
        const shadow = document.querySelector(".shadow");

        menus.forEach((menu, index) => {
            menu.addEventListener("click", handleOnClickToggleMenu);
        });
        links.forEach((link, index) => {
            link.addEventListener("click", handleOnClickToggleMenu);
        });

        function handleOnClickToggleMenu(e) {
            window.scrollTo(0, 0);
            nav.classList.toggle("nav-active");
            shadow.classList.toggle("shadow-active");
            nav.classList.toggle("nav-inactive");
            shadow.classList.toggle("shadow-inactive");
        }

        document .querySelector(".vertical-menu-butt").addEventListener("click", function () {
            var x = document.querySelector(".vertical-menu");
            if (x.classList.contains("hidden-menu")) {
                x.classList.add("show-menu");
                x.classList.remove("hidden-menu");
            } else {
                x.classList.remove("show-menu");
                x.classList.add("hidden-menu");
            }
        });

        document .querySelector(".diamond").addEventListener("mouseover", function () {
            var x = document.querySelector(".tool-tip");
            x.classList.add("show-menu");
            x.classList.remove("hidden-menu");
        });

        document .querySelector(".diamond").addEventListener("mouseout", function () {
            var x = document.querySelector(".tool-tip");
            x.classList.remove("show-menu");
            x.classList.add("hidden-menu");
        });

        var timers, starts;
        function showTimerAlert(text) {

            for (var i = 0 ; i < timers ; i++) clearTimeout(i);
            for (var a = 0 ; a < starts ; a++) clearTimeout(a);

            document.querySelector(".timer-alert").classList.remove("show-timer");
            document.querySelector(".timer-alert .progress").classList.remove("start");

            setTimeout(function () {
                document.querySelector(".timer-alert").classList.add("show-timer");
                document.querySelector(".timer-alert").classList.remove("hidden-timer");
                document.querySelector(".timer-alert .text").innerText = text;
                document.querySelector(".timer-alert .progress").classList.add("start");
            }, 5);

            timers = setTimeout(function () {
                document.querySelector(".timer-alert").classList.remove("show-timer");
                document.querySelector(".timer-alert").classList.add("hidden-timer");
                starts = setTimeout(function () {
                    document.querySelector(".timer-alert .progress").classList.remove("start");                    
                }, 500);
            }, 4700);
        }

        function showAlert(e, id) {
            document.querySelector(".popup[data-id='" + e.dataset.id + "']").classList.add("show-timer");
            document.querySelector(".popup[data-id='" + e.dataset.id + "']").classList.remove("hidden-timer");
            document.querySelector(".popup[data-id='" + e.dataset.id + "'] #" + id).classList.remove("hidden");
        }
        function hideAlert(e, id) {
            document.querySelector(".popup[data-id='" + e.dataset.id + "']").classList.remove("show-timer");
            document.querySelector(".popup[data-id='" + e.dataset.id + "']").classList.add("hidden-timer");
            document.querySelectorAll(".popup[data-id='" + e.dataset.id + "'] > div").forEach((el, index) => {
                el.classList.add("hidden");
            });
        }

    </script>

</body>

</html>
