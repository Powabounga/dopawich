<!DOCTYPE html>
<html lang="fr">

<head>
    <meta name="google-site-verification" content="hasfRog2JYBCQS47mpjEE-qe6rl6_ZAcCVrs9QQiCAQ" />
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="Description"
        content="Vous souhaitez faire un don pour aider les personnes dans le besoin? Rejoignez-nous !" />
    <link rel=" icon" href="/images/dopawich_logo.png" />
    <link rel="stylesheet" href="/css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Dopawich</title>
</head>

<body>
    <div class="container mt-5 pt-5">
        <?php if(!empty($_SESSION['message'])): ?>
        <div class="alert alert-success m-5" role="alert">
            <?= $_SESSION['message']; unset($_SESSION['message']);?>
        </div>
        <?php endif; ?>
        <?php if(!empty($_SESSION['erreur'])): ?>
        <div class="alert alert-danger m-5" role="alert">
            <?= $_SESSION['erreur']; unset($_SESSION['erreur']);?>
        </div>
        <?php endif; ?>
        <?= $contenu ?>
    </div>
    <header>
        <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand ms-5" href="/">
                    <img src="/images/dopawich_logo.png" alt="Dopawich logo" width="me-auto" height="75" />
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                    aria-controls="#navbarContent" aria-expanded="true" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse ms-3" id="navbarContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-1">
                        <li class="nav-item">
                            <a class="nav-link m-2" href="/main/quisommesnous">Qui sommes-nous ?</a>
                        </li>
                        <?php if(isset($_SESSION['user']) && !empty($_SESSION['user']['id'])): ?>
                        <li class="nav-item">
                            <a class="nav-link m-2" href="/main/participer">Participer</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link m-2" href="/users/logout">Déconnexion</a>
                        </li>
                        <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link m-2" href="/users/login">Se connecter</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link m-2" href="/users/register">S'enregistrer</a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>