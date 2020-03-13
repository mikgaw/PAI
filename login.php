<!doctype html>
<html lang="pl">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Logowanie</title>
  </head>
  <body>
  <?php
  require_once('modules/alertMessages.php');
  ?>
        <div class="col-12 mt-5">
                <h1 class="text-center font-weight-bold">Zaloguj się</h1>
        </div>
        
        <form action="./controllers/loginUserController.php" class="form-signin mt-5" method="POST">
            <div class="col-12 d-flex justify-content-center mt-4">
                <label for="nick" class="sr-only">email</label>
                <input type="text" name="email" id="nick" placeholder="Nick" class="col-lg-4 col-md-8 col-sm-12 m-3 form-control">
            </div>

            <div class="col-12 d-flex justify-content-center mt-4">
                <label for="password" class="sr-only">Hasło</label>
                <input type="password" name="password" id="password" placeholder="Hasło" class="col-lg-4 col-md-8 col-sm-12 m-3 form-control">
            </div>
            <div class="col-12 d-flex justify-content-center mt-4">
                <input type="submit" value="Zaloguj" class="btn btn-success col-lg-4 col-md-8 m-3 col-sm-12">
            </div>
            <div class="col-12 d-flex justify-content-center">
                <a class="btn btn-primary col-lg-4 col-md-8 col-sm-12 m-3" href="register.php">Nie mam konta</a>
            </div>
        </form>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>