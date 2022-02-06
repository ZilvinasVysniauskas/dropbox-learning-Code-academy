<!doctype html>
<?php $sessionId = (isset($_SESSION['id']))?$_SESSION['id']:'';?>
<html lang="en">
<head>
    <script type="text/javascript">
        var globalSessionId = '<?=$sessionId?>';
    </script>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital
        ,wght@0,500;1,300;1,800&family=Raleway:wght@300;400&display=swap"
        rel="stylesheet">
    <!--bootstrap5-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
          crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--bootstrap3 modal class-->
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="style/index.css">
    <!--custom css link-->
    <title>Hello, world!</title>

</head>
<body>



<div class="container-fluid">

        <div><?=$login ?? null ?></div>

    <div class="row">

        <div class="col-sm-12 col-md-3 col-l-2 col-xl-2 layout1"><?=$logged ?? null ?></div>

        <div class="col-sm-12 col-md-9 col-l-10 col-xl-10 ">
            <div><?=$search ?? null ?></div>
            <div><?=$output ?? null ?></div>
        </div>

    </div>

</div>


<script src="https://kit.fontawesome.com/dfecaa1509.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

</body>
</html>
