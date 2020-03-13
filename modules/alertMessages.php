<?php
if(!empty($_GET)){
    if(isset($_GET['done'])){
        echo '
        <div class="col-lg-12 d-flex justify-content-center">
        <div class="alert alert-success">
        '.$_GET['done'].'</div>
        </div>';
    }
    if(isset($_GET['fail'])){
        echo '
        <div class="col-lg-12 d-flex justify-content-center">
        <div class="alert alert-danger">
        '.$_GET['fail'].'</div>
        </div>';
    }
}