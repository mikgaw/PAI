<?php
session_start();
if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] !== true){
    die("Dostęp zabroniony!!!");
}
?>
<!doctype html>
<html lang="pl">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Dashboard</title>
    <style>
    tr:hover{
        background-color:#ffddff;
    }
    img{
        width:48px;
        cursor:pointer;
    }
    #hidden{
        visibility:hidden;
    }
    </style>
</head>

<body>
    <div class="col-12">
        <h1 class="text-center font-weight-bold p-5">Prowadzący</h1>
        <div class="text-center">
            <a href="../index.php" class="m-2 text-success">POWRÓT</a> | <a href="./courses.php" class="m-2">Kursy</a> | <a href="../logout.php" class="m-2 text-danger">WYLOGUJ</a>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">
                        </th>
                        <th scope="col">Imie</th>
                        <th scope="col">Nazwisko</th>
                        <th scope="col">Specjalizacja</th>
                        <th scope="col">Ilość kursów</th>
                        <th scope="col">Usuń</th>
                    </tr>
                </thead>
                <tbody>
                    <script>
                    </script>
                </tbody>
            </table>


        </div>
        <div class="row d-flex justify-content-center">
                    <div class="col-lg-2 text-center">
                        <img src="../assets/addItem.png" alt="" onclick = "addItem()" srcset="">
                    </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <script>
    function addItem(){
        document.querySelector('#hidden').style.visibility = "visible";
    }
    function generateProfList(){
        fetch('../controllers/getAllProfController.php')
            .then(
                function(response) {
                    if (response.status !== 200) {
                        console.log('Looks like there was a problem. Status Code: ' +
                            response.status);
                        return;
                    }

                    // Examine the text in the response
                    response.json().then(function(data) {
                        data.forEach(el => {
                            console.log(el);
                            var content = `
                                    <tr>
                                    <td></td>
                                    <td>`+el.name+`</td>
                                    <td>`+el.surname+`</td>
                                    <td>`+el.specialization+`</td>
                                    <td>`+el.number_of_courses+`</td>
                                    <td> <button class="btn btn-danger" value="`+el.id+`" onclick="deleteProf(this)">USUŃ</button></td>
                                    </tr>
                                    `
                            document.querySelector('tbody').innerHTML += content;
                        });

                        document.querySelector('tbody').innerHTML += `
                            <tr id="hidden">
                                    <td></td>
                                    <td><input type="text" name="name" id="name" placeholder="Imię"></td>
                                    <td><input type="text" name="surname" id="surname" placeholder="Nazwisko"></td>
                                    <td><input type="text" name="specialization" id="specialization" placeholder="Specjalizacja"></td>
                                    <td></td>
                                    <td> <button class="btn btn-success" onclick="createNewProf()">DODAJ</button></td>
                            </tr>`
                    })

                }
            )
            .catch(function(err) {
                console.log('Fetch Error :-S', err);
            });

    }
    function createNewProf(){
        const formData = new FormData();

        formData.append('name', document.querySelector('#name').value);
        formData.append('surname', document.querySelector('#surname').value);
        formData.append('specialization', document.querySelector('#specialization').value);
        try {
            const response = fetch('../controllers/createNewProfController.php', {
                method: 'POST',
                body: formData
            });
            location.reload();
        } catch (error) {
            console.error('Error:', error);
        }
    }
    function deleteProf(current){
        var confirm = window.confirm("Usunięcie prowadzącego jest równoznaczne z usunięciem jego wszystkich kursów! Kontynuować?");
        if(!confirm) return 0;
        const formData = new FormData();
        formData.append('id_prof', current.value);
        try {
            const response = fetch('../controllers/deleteProfController.php', {
                method: 'POST',
                body: formData
            });
            location.reload();
        } catch (error) {
            console.error('Error:', error);
        }
    }
    generateProfList();
    </script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>

</html>