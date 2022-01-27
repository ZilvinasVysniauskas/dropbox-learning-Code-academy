<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
            href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,500;1,300;1,800&family=Raleway:wght@300;400&display=swap"
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



<div class="section1">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-3 col-l-2 col-xl-2 leftBox">
                <div class="imgDiv d-flex justify-content-center mt-3 mb-5">
                    <img src="img/blue_dropbox_glyph-vflJ8-C5d.png" alt="">
                </div>
                <div class="small">
                    <div class="menuImg d-flex align-items-center mt-3">
                        <img src="img/files.png" alt="">
                        <h3>files</h3>
                    </div>
                    <div class="menuImg d-flex align-items-center mt-3">
                        <img src="/img/photos.png" alt="">
                        <h3>photos</h3>
                    </div>
                    <div class="menuImg d-flex align-items-center mt-3">
                        <img src="/img/sharing.png" alt="">
                        <h3>sharing</h3>
                    </div>
                    <div class="menuImg d-flex align-items-center mt-3">
                        <img src="/img/links.png" alt="">
                        <h3>links</h3>
                    </div>
                    <div class="menuImg d-flex align-items-center mt-3">
                        <img src="/img/events.png" alt="">
                        <h3>events</h3>
                    </div>
                    <div class="menuImg d-flex align-items-center mt-3">
                        <img src="/img/asd.png" alt="">
                        <h3>get started</h3>
                    </div>
                </div>
                <div id="scoreBoard">
                    <p><span id="scoreNumber">50</span>mb / 30 mb</p>
                    <div id="fullScore">
                        <div id="insideScore"></div>
                    </div>

                </div>

            </div>
            <div class="col-sm-12 col-md-9 col-l-10 col-xl-10 rightBox">
                <div class="d-flex justify-content-between">
                    <form action="">
                        <input type="text" placeholder="Search...">
                    </form>
                    <p><b>Eddie Labanovskiy</b></p>
                </div>
                <div class="mt-3">
                    <h2>photos</h2>
                </div>
                <div class="d-flex justify-content-between actionIcons">
                    <div class="d-flex align-items-center">
                        <div class="actionIcon1">
                            <img src="/img/rOne@4x.png" alt="">
                            <div class="actionName actionName1">upload</div>
                            <div class="upload align-items-center justify-content-center" id="upload">
                                <form action="post.php" method="post" enctype="multipart/form-data">
                                    <input type="file" name="file[]" multiple="multiple">
                                    <input type="submit">
                                </form>

                            </div>
                        </div>
                        <div class="actionIcon2">
                            <img src="/img/rTwo@4x.png" alt="">
                            <div class="actionName actionName2">add folder</div>
                        </div>
                        <div class="actionIcon3">
                            <img src="/img/rThree@4x.png" alt="">
                            <div class="actionName actionName3">insert</div>
                        </div>
                        <div class="actionIcon4">
                            <img src="/img/rFour@4x.png" alt="">
                            <div class="actionName actionName4">delete</div>
                        </div>
                    </div>
                    <div class="d-flex">
                        <h3>name</h3>
                        <h3>size</h3>
                        <h3>modified</h3>
                    </div>
                </div>

                <div class="photoDiv row" id="photoDiv">
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/index.js"></script>
<script src="https://kit.fontawesome.com/dfecaa1509.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

</body>
</html>

