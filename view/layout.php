<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tiny.cloud/1/zg3mwraazn1b2ezih16je1tc6z7gwp5yd4pod06ae5uai8pa/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
    <link rel="stylesheet" href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css' type='text/css'>
    <link rel="stylesheet" href="/public/css/style.css">
    <title>FORUM</title>
</head>

<body>
    <div class='TheForum'>
        <h1>THE FORUM</h1>
    </div>
    <main>
    <div class="menu">
            <a href="/">HOME</a>
        <?php if (App\Session::isAdmin()) { ?>
            <a href="index.php?ctrl=home&action=users">USERS</a>
        <?php } 
        if (App\Session::getUser()) { ?>
            <a href="index.php?ctrl=forum&action=userProfile&id=<?= App\Session::getUser()->getId() ?>"><span class="fas fa-user"></span>PROFILE</a>
            <a href="index.php?ctrl=security&action=logout">LOG OUT</a>
        <?php } 
        else { ?>
            <a href="index.php?ctrl=security&action=login">SIGN IN</a>
            <a href="index.php?ctrl=security&action=register">REGISTER</a>
        <?php } ?>
    </div>  




        <?= $page ?>
   
     
        </main>

    <div class='footer'>
        <p>&copy; 2023 - Forum CDA - <a href="/home/forumRules.html">Forum Rules</a> - <a href="">Legal mentions</a></p>
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