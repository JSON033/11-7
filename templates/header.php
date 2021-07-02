<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>11-7</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style type="text/css">
        .brand {
            background: #cbb09c !important;
        }

        .brand-text {
            color: white !important;
        }

        form {
            max-width: 460px;
            margin: 20px auto;
            
        }
        nav{
            padding-bottom: 80px;
        }
    </style>

    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script>
    $( document ).ready(function() {
        
        $(".dropdown-trigger").dropdown();
    });
 
    
    </script>
    <!-- Compiled and minified JavaScript -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>




</head>



<body class="white lighten-2">
    <ul id="dropdown1" class="dropdown-content">
                        <li><a href="index.php?typ=SNACK">Snacks</a></li>
                        <li class="divider"></li>
                        <li><a href="index.php?typ=BEVERAGE">Beverages</a></li>
                        <li class="divider"></li>
                        <li><a href="index.php?typ=CANDY">Candy</a></li>
                        <li class="divider"></li>
                        <li><a href="index.php?typ=FROZEN">Frozen</a></li>
                        <li class="divider"></li>
                        <li><a href="index.php?typ=LIQUOR">Liquor</a></li>
                    </ul>
        <div class="navbar-fixed">
    <nav class="orange z-depth-0">
        <div class="container">
            
                <a href="index.php" class="brand-logo"><img src="img\11-7.png" width="200" height="60" ?> </a>
                <ul id="nav-mobile" class="right hide-on-small-down">
                     <li><a href="additem.php" class="btn brand z-depth-0">create item</a></li>
                    <li><a href="shopping.php"><i class=" material-icons z-depth-0 ">shopping_cart</i> </a> </li> 

                    <li><a class="dropdown-trigger " href="#!" data-target="dropdown1">Departments<i class="material-icons right">arrow_drop_down</i></a></li>
                    
                </ul>
                <form method="POST" action="index.php?">
                    <div class="input-field left">
                        <label class="label-icon " for="search"><i class="material-icons ">search</i></label>
                        <input id="search" name='search' type="search" required>

                        <i class="material-icons">close</i>
                    </div>
                </form>

        </div>
            </div>
        
</div>