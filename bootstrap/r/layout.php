<?php
function render($view = null){
?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="admin.css">
        <script src="https://kit.fontawesome.com/0eb6dfa52b.js" crossorigin="anonymous"></script>
        <title>Siteawos</title>
        <style>
            .compass {
                position: relative;
                width: 320px;
                height: 320px;
                border-radius: 50%;
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
                margin: auto;
                }
                .compass > .arrow-wrapper {
                    border: 1px solid green;
                    position: relative;
                    width: 100%;
                    height: 100%;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%) rotate(0deg);
                    transition: transform 1s ease-in-out;
                    background-size: contain;
                    border-radius: 50%;
                    z-index: 98;
                }
                .compass .arrow {
                position: absolute;
                width: 0;
                height: 0;
                top: 20px;
                left: 50%;
                transform: translateX(-50%) rotate(180deg);
                border-style: solid;
                border-width: 20px 10px 0 10px;
                border-color: green transparent transparent transparent;
                z-index: 99;
                }

                .compass > .compass-circle,
                .compass > .my-point {
                position: absolute;
                width: 100%;
                height: 100%;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%) rotate(90deg);
                transition: transform 0.1s ease-out;
                background: url('./i/compass-rounded.png') center
                    no-repeat;
                background-size: contain;
                }
                .compass > .my-point {
                opacity: 0;
                width: 20%;
                height: 20%;
                background: rgb(8, 223, 69);
                border-radius: 50%;
                transition: opacity 0.5s ease-out;
                }
                
                .compass > .wind-speed {
                    position: absolute;
                    top: 47%;
                    left: 53%;
                    transform: translate(-50%, -50%);
                }
                .compass > .wind-speed > .num {font-weight: bold;font-size: 3.5rem;color: green;font-family: serif;}
                .compass > .wind-speed > .text {font-weight: bold; color: green;}
                .compass > .direction {
                    position: absolute;
                    top: 75%;
                    left: 51%;
                    transform: translate(-50%, -50%);
                    font-weight: bold;font-size: 1.7rem;color: green;font-family: serif;
                }

        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-info fixed-top">
            <a class="navbar-brand " href="#">Web Observation | Siteawos</a>
        </nav>
        <div class="row no-gutters mt-5">
            <div class="col-md-2 bg-dark mt-2 pr-3 pt-4">
                <ul class="nav flex-column ml-3 mb-5">
                    <li class="nav-item">
                        <a class="nav-link active text-white" href="?v=dashboard"><i class="fas fa-home mr-2"></i>Home</a>
                        <hr class="bg-secondary">
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="?v=pengamatan"><i class="fas fa-binoculars mr-2"></i>Pengamatan</a>
                        <hr class="bg-secondary">
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="?v=tentang"><i class="fas fa-user-tie mr-2"></i>Tentang</a>
                        <hr class="bg-secondary">
                    </li>
                </ul>
            </div>
            <div class="col-md-10 p-5 pt-2">
            <?php
                if(!$view) {
                    require_once('r/sections/dashboard.php');
                } else if(file_exists('r/sections/'.$view.'.php')) {
                    require_once('r/sections/'.$view.'.php');
                } else {
                    require_once('r/sections/dashboard.php');
                }
            ?>
            </div>
        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script type="text/javascript" src="admin.js"></script>
    </body>
</html>
<?php
}
?>