<?php

require_once 'Config/Functions.php';
$Fun_call = New Functions();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Youtube Gallery</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="Stylesheet/stylesheet.css">
</head>

<body>

    <div class="container-fluid">
        <div class="container">
            <ul class="nav justify-content-center bg-dark">
                <li class="nav-item">
                    <div class="nav-link heading">Live Search</div>
                </li>
            </ul>
        </div>

        <div class="container">
            <div class="ins-box">
                <form method="post" autocomplete="off">
                    <div class="form-row justify-content-center">
                        <div class="form-group col-sm-12 col-lg-10 mb-0">
                            <input type="text" id="search_key" name="search_key" class="form-control" placeholder="Search Now" maxlength="100">
                        </div>
                    </div>
                </form>
                <span id="search_msg" class="ser-msg"></span>
            </div>
        </div>

        <div class="container">
            <div class="ins-box ins-box-set">
                <table class="table table-hover">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Gender</th>
                        <th scope="col">DOB</th>
                        <th scope="col">Nationality</th>
                      </tr>
                    </thead>
                    <tbody id="record_load">

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function (){

            $('#record_load').load('Ajax/Records.php');

            $('#search_key').keyup(function (){

                $search_data = $(this).val().trim();

                if($search_data != '' && $search_data.match(/^[a-zA-Z0-9 ]*$/)){

                    $('#search_msg').text('');
                    $('#record_load').load('Ajax/Records.php', { 'search_keyword' : encodeURIComponent($search_data) });
                
                }
                else{

                    $('#record_load').load('Ajax/Records.php');
                    if(!$search_data.match(/^[a-zA-Z]*$/)){
                        $('#search_msg').text('Only Alphabet & Numbers Are Allow');
                    }
                    if($search_data == ''){
                        $('#search_msg').text('');
                    }
                }

            });

        });
    </script>


</body>

</html>