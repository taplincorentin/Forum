<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tiny.cloud/1/zg3mwraazn1b2ezih16je1tc6z7gwp5yd4pod06ae5uai8pa/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"
        integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    <link rel="stylesheet" href="/public/css/style.css">
    <title>FORUM</title>
</head>

<body>
    <div id="wrapper">

        <div id="mainpage">
            <!-- c'est ici que les messages (erreur ou succès) s'affichent-->
            <h3 class="message" style="color: red">
                <?= App\Session::getFlash("error") ?>
            </h3>
            <h3 class="message" style="color: green">
                <?= App\Session::getFlash("success") ?>
            </h3>
            <header>
                <nav>
                    <ul>
                                <li><a href="/">HOME</a></li>
                        <?php
                        if (App\Session::isAdmin()) {
                            ?>  <li>
                                    <a href="index.php?ctrl=home&action=users">USERS</a>
                                </li>
                        <?php } ?>
                        <?php
                        if (App\Session::getUser()) { ?>
                                <li style="float:right">
                                    <a href="index.php?ctrl=forum&action=userProfile&id=<?= App\Session::getUser()->getId() ?>">
                                    <span class="fas fa-user"></span><?= App\Session::getUser()->getUsername() ?></a>
                                </li>
                                <li style="float:right">
                                    <a href="index.php?ctrl=security&action=logout">LOG OUT</a>
                                </li>
                        <?php } 
                        else { ?>
                                <li>
                                    <a href="/security/login.html">SIGN IN</a>
                                </li>
                                <li>
                                    <a href="/security/register.html">REGISTER</a>
                                </li>
                        <?php } ?>
                    </ul>
                </nav>
            </header>

            <main id="forum">
                <?= $page ?>
            </main>
        </div>
        <footer>
            <p>&copy; 2023 - Forum CDA - <a href="/home/forumRules.html">Forum Rules</a> - <a href="">Legal mentions</a></p>
            <!--<button id="ajaxbtn">Surprise en Ajax !</button> -> cliqué <span id="nbajax">0</span> fois-->
        </footer>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous">
        </script>
    <script>

        $(document).ready(function () {
            $(".message").each(function () {
                if ($(this).text().length > 0) {
                    $(this).slideDown(500, function () {
                        $(this).delay(3000).slideUp(500)
                    })
                }
            })
            $(".delete-btn").on("click", function () {
                return confirm("Etes-vous sûr de vouloir supprimer?")
            })
            tinymce.init({
                selector: '.post',
                menubar: false,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table paste code help wordcount'
                ],
                toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                content_css: '//www.tiny.cloud/css/codepen.min.css'
            });
        })



        /*
        $("#ajaxbtn").on("click", function(){
            $.get(
                "index.php?action=ajax",
                {
                    nb : $("#nbajax").text()
                },
                function(result){
                    $("#nbajax").html(result)
                }
            )
        })*/
    </script>
</body>

</html>