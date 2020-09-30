<!DOCTYPE html>
<head>
    <title>Battle Simulator</title>
    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" 
    integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <div class="row mt-4">
        <div class="col-12">
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">Battle Simulator</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <h4>LET'S BATTLE</h4>
        </div>
        <div class="col-6">
            <form action="api/battle/create.php" method="post">
                <div class="my-3" id="newbattle"><button type="submit" class="btn btn-warning">New battle</button></div>
            </form>
            <div class="my-3" id="newarmy" data-toggle="modal" data-target="#newArmy"><button type="button" class="btn btn-warning">New army</button></div>
            <div class="my-3"><button type="button" class="btn btn-lg btn-warning">RUN ATTACK</button></div>
            <div class="my-3"><button type="button" class="btn btn-dark">AUTORUN</button></div>
        </div>
    </div>
</div>

<?php include_once 'new_army.php'; ?>

<!-- BOOTSTRAP JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" 
integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" 
integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" 
integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>