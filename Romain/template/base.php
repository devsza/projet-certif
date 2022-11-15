<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/c60d56f229.js" crossorigin="anonymous"></script>
    
    

    <title>Dead by Daylight - <?php echo getPageTitle()?></title>

<link rel="stylesheet" href="/Romain/public/css/style.css">

</head>

<body>

<header>
    <?php  include_once "template_part/header/header.php";?>
</header>
<main>
    
     <section class="hero-section">

            <div class="contain-hero-section">
    
                <h1>Dead by Daylight</h1>
    
                <div class="btn-hero-section">

             <?php if (
                        isset($_SESSION["user_is_connected"])
                        && $_SESSION["user_is_connected"]
                    ) { ?>
                        <a href="./?page=user_disconnect">DECONNEXION</a>
                    <?php }else { ?>
                        <a href="./?page=user_connexion">CONNEXION</a>
                        <a href="./?page=user_add">INSCRIPTION</a>
                    <?php } ?>
                </div>
    
                <div class="picto-hero-section">
    
                    <a href="https://twitter.com/?lang=fr" target="blank">
                        <i class="fa fa-twitter"></i>
                    </a>
                    <a href="https://www.instagram.com/?hl=fr" target="blank">
                        <i class="fa fa-instagram"></i>
                    </a>
                    <a href="https://fr-fr.facebook.com/" target="blank">
                        <i class="fa fa-facebook"></i>
                    </a>
    
                </div>
    
            </div>
    
        </section>
        
        <div class="container">
        <?php getRouteFromUrl() ?>
    </div>
</main>

<footer>
    <?php  include_once "template_part/footer/footer.php"; ?>
</footer>
<script type="text/javascript" src="/Romain/public/script/script.js"></script>
</body>

</html>