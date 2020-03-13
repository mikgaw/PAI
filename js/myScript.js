function smoothScroll(element){
    document.querySelector(element).scrollIntoView({
        behavior: 'smooth'
    });
}
function getUserData(){
    fetch('./controllers/getUserDataController.php')
        .then(
            function(response) {
                if (response.status !== 200) {
                    console.log('Looks like there was a problem. Status Code: ' +
                        response.status);
                    return;
                }
                // Examine the text in the response
                response.json().then(function(data) {
                    user = data;
                    return user;
                })
            }
        )
        .catch(function(err) {
            console.log('Fetch Error :-S', err);
        });
}

function reserve(book,user){
    var select = document.getElementById('booksSelect');
    var options_selected = select.querySelectorAll('option[selected]');
    options_selected.forEach(function(option){
        option.removeAttribute("selected");
    });
    var option = select.querySelector('option[value="'+book+'"]');
    option.setAttribute("selected","selected");
    fetch('./controllers/getUserDataController.php')
        .then(
            function(response) {
                if (response.status !== 200) {
                    console.log('Looks like there was a problem. Status Code: ' +
                        response.status);
                    return;
                }
                // Examine the text in the response
                response.json().then(function(data) {
                    user = data;
                    document.getElementById('name').value = user.name;
                    document.getElementById('surname').value = user.surname;
                    document.getElementById('phone_number').value = user.phone_number;
                })
            }
        )
        .catch(function(err) {
            console.log('Fetch Error :-S', err);
        });
    smoothScroll('form');
}
function getAllProf(){
    fetch('./controllers/getAllProfController.php')
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
                        var content = `<div class="col-lg-4 col-md-6 col-sm-12 mt-3">
                                    <div class="card"><img src="https://www.wprost.pl/_thumb/5f/d7/c90954d11ee98be97a1d0302dcf6.jpeg"
                                            class="card-img-top" alt="car">
                                        <div class="card-body">
                                        <p class="text">`+el.specialization+`</p>
                                            <h5 class="card-title text-center">`+el.surname+`</h5>
                                            <p class="text-center">`+el.name+`</p>
                                        </div>
                                    </div>
                                </div>`
                        document.getElementById('professors').innerHTML += content;
                    });

                })

            }
        )
        .catch(function(err) {
            console.log('Fetch Error :-S', err);
        });
}
getAllProf();
function generateSelectList(){
    fetch('./controllers/getAllCoursesController.php')
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
                        var content = `<option value="`+el.id+`">`+el.title+'</option>';
                        document.getElementById('booksSelect').innerHTML += content;
                    });

                })

            }
        )
        .catch(function(err) {
            console.log('Fetch Error :-S', err);
        });
}
generateSelectList();

function getAllCourses(){
    fetch('./controllers/getAllCoursesController.php')
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
                        var content = `<div class="col-lg-4 col-md-6 col-sm-12 mt-3">
                    <div class="card"><img src="https://epedagogika.pl/appFiles/site_141/images/doc/qpy7QL6MZGoUJVn.jpeg"
                            class="card-img-top" alt="car">
                        <div class="card-body">
                        <p class="text">`+el.description+`</p>
                            <h5 class="card-title text-center">`+el.title+`</h5>
                            <p class="text-center">`+el.name+`</p>
                            <button class="btn btn-success col-12"
                                onclick="reserve(`+el.id+`)">DOLACZ</button>
                        </div>
                    </div>
                </div>`
                        document.getElementById('courses').innerHTML += content;
                    });

                })


            }
        )
        .catch(function(err) {
            console.log('Fetch Error :-S', err);
        });
}
getAllCourses();

function reserveCourse(){
    if(!allowSending) return 0;
    const formData = new FormData();
    formData.append('book_id', document.getElementById('booksSelect').value);
    fetch('./controllers/getUserDataController.php')
        .then(
            function(response) {
                if (response.status !== 200) {
                    console.log('Looks like there was a problem. Status Code: ' +
                        response.status);
                    return;
                }
                // Examine the text in the response
                response.json().then(function(data) {
                    user = data;
                })
            }
        )
        .catch(function(err) {
            console.log('Fetch Error :-S', err);
        });
    formData.append('name', user.name);
    formData.append('surname', user.surname);
    formData.append('phone_number', user.phone_number);
    try {
        const response = fetch('./controllers/reserveCourseController.php', {
            method: 'POST',
            body: formData
        });
        const result = response.json();
        console.log('Success:', JSON.stringify(result));
    } catch (error) {
        console.error('Error:', error);
    }
}


function fillUserData() {
    fetch('./controllers/getUserDataController.php')
        .then(
            function (response) {
                if (response.status !== 200) {
                    console.log('Looks like there was a problem. Status Code: ' +
                        response.status);
                    return;
                }
                // Examine the text in the response
                response.json().then(function (data) {
                    user = data;

                    document.getElementById('name').value = user.name;
                    document.getElementById('name').setAttribute('disabled', 'disabled');
                    document.getElementById('surname').value = user.surname;
                    document.getElementById('surname').setAttribute('disabled', 'disabled');
                    document.getElementById('phone_number').value = user.phone_number;
                    document.getElementById('phone_number').setAttribute('disabled', 'disabled');


                })
            }
        )
        .catch(function (err) {
            console.log('Fetch Error :-S', err);
        });
}
fillUserData();
window.addEventListener("load", function() {
    var now = new Date();
    var offset = now.getTimezoneOffset() * 60000;
    var adjustedDate = new Date(now.getTime() - offset + 1000*60*60*24);
    var formattedDate = adjustedDate.toISOString().substring(0,16); // For minute precision
    var datetimeField = document.getElementById("date");
    datetimeField.value = formattedDate;
});
var dateTimeStr = document.getElementById("dateTime").value;

var dateTime = convertDateToUTC(new Date(dateTimeStr));
var now = new Date();


