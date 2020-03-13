<?php 
require('modules/loginCheck.php');
?>
<!doctype html>
<html lang="pl">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="shortcut icon" href="assets/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <title>E-SZKOLA</title>
    <script src="https://kit.fontawesome.com/0b7d52a410.js"></script>
    <style>
    .card .text {
position:absolute;
left:0;
display:none;
z-index:10;
font-size:16px;
color:white;
width:100%;
padding:25px 15px;
top:50px;
  transition-duration: 5s;
  transition-delay: 2s;
}
.card img{
    position:relative;
}
.card img:hover{
    filter:brightness(10%);
    cursor:pointer;
}
.card:hover .text {
display:block;
text-align:center;
}
        .alert{
            padding-top:5px;
            padding-bottom:5px;
            margin-top:10px;
            visibility:hidden;
        }
    </style>
</head>

<body>
    <!--header-->
    <script>

    </script>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark pl-4">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto"> 
                    <?php
                    require_once('./modules/adminMenu.php');
                    ?>
                    <li class="nav-item pr-3">
                        <a class="nav-link" onclick="smoothScroll('#avalible')">Kursy</a>
                    </li>
                    <li class="nav-item pr-3">
                        <a class="nav-link" onclick="smoothScroll('#professors')">Prowadzący</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Wyloguj</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container h-75">
            <div class="row mt-5 pt-5">
                <div class="col-12 mt-5 pt-5">
                    <h1 class="text-white font-weight-bold text-center">E-SZKOŁA</h1>
                </div>
                <div class="col-12">
                    <div class="row mt-5 d-flex justify-content-center">
                        <button class="col-lg-3 col-md-6 col-sm-12 m-4 p-3 font-weight-bold text-center"
                            onclick="smoothScroll('#avalible')">Kursy</button>
                        <button class="col-lg-3 col-md-6 col-sm-12 m-4 p-3 font-weight-bold text-center"
                            onclick="smoothScroll('#professors')">Prowadzący</button>

                    </div>
                </div>
            </div>
        </div>
    </header>
    <!--header-->
    <!--avalible-->
    <section id="avalible" class="pt-4 pb-4">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="text-center pt-4 pb-4">Kursy</h1>
                </div>
            </div>
            <div class="row d-flex justify-content-center" id="courses">

            </div>
        </div>
    </section>
    <!--avalible-->


    <section id="unavalible" class="pt-4 pb-4">
        <div class="container">
            <div class="row" id="professors">
                <div class="col-12 pt-5">
                    <h1 class="text-center pt-4 pb-4">Prowadzacy</h1>
                </div>
            </div>

            </div>
        </div>
    </section>


    <!--unavalible-->
    <section id="unavalible" class="pt-4 pb-4">
        <div class="container">
            <div class="row" id="unavalible-books">
                <div class="col-12 pt-5">
                    <h1 class="text-center pt-4 pb-4">Zapisz się na kurs</h1>
                </div>
            </div>

            </div>
        </div>
    </section>
    <!--unavalible-->
    <!--reservation form-->
    <section id="reservation">
        <div class="container-fluid">
            <h1 class="text-center pt-4 pb-4 text-white font-weight-bold"></h1>
            <div class="row">
                <div class="col-12 text-center text-info">
                 
                </div>
                <div class="col-12 d-flex justify-content-center p-5 text-white">
                    <form action="">
                    <div class="form-group text-center">
                            <label class="text-center" for="car">Kurs</label>
                            <select name="book" class="form-control" id="booksSelect">
                 
                            </select>

                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group text-center">
                                    <label class="text-center" for="name">Imię</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="Podaj imię" required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group text-center">
                                    <label class="text-center" for="surname">Nazwisko</label>
                                    <input type="text" class="form-control" name="surname" id="surname"
                                        placeholder="Podaj nazwisko" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <label class="text-center" for="phone">Telefon</label>
                            <input type="tel" id="phone_number" name="phone" class="form-control" placeholder="Podaj numer telefonu"
                                required>
                        </div>
                            

                                </div>
                                <div class="col-12 mt-4">
                            <button value="DOLACZ" class="btn btn-info col-12" onclick="reserveCourse()">Zapisz się</button>
                        </div>
                            </div>
                        </div>
                
                    </form>
                </div>
            </div>
        </div>
    </section>
   
    <!--reservation form-->
    <footer class="page-footer font-small p-3">
        
        <div class="footer-copyright text-center font-weight-bold">
            Copyright: 
        </div>
    </footer>
    <!-- Optional JavaScript -->
    <script>
        allowSending = true;
        document.querySelector('#date').addEventListener("change",function(){
            var d = new Date();
            var currentDate = d.getFullYear()+'-'+(addZeroIfNeeded(d.getMonth()))+'-'+addZeroIfNeeded(+d.getDate())+' '+addZeroIfNeeded(d.getHours())+':'+addZeroIfNeeded(d.getMinutes());
            currentDate = Date.parse(currentDate);
        });


        function addZeroIfNeeded(param){
            if(param < 10){
                return '0'+param;
            }
            else return param;
        }
    </script>
    <script src="js/myScript.js"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>