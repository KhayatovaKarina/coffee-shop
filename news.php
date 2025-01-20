<? // Подключение БД
include("apps/php/db.php");

// Получение id выбранной новости
$news_id = $_GET['news_id'];?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffeee shop</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Icons+Outlined">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    

    <!-- Новость -->
    <section id="section-news" class="section-main">
        <div class="container">
            <a class="news__link" href="index.php#section-news">Назад <span class="material-icons-outlined">arrow_forward</span></a>

            <?  $query = $pdo->prepare('SELECT * FROM `news` WHERE news_id = ?');
                    $query->execute([$news_id]);
                    while ($row = $query->fetch(PDO::FETCH_ASSOC)){
                        echo '<h2 class="section-title">'.$row["news_date"].'</h2>
                              <h3 class="section-subtitle">'.$row["news_caption"].'</h3>
                              <div class="news-wrap__page">
                              <div class="news__page">
                              <span class="news__author"><span class="news__author_dark">От: </span>'.$row["news_author"].'</span>
                              <img class="page-news__img" src="'.$row["news_img"].'" alt="#"></div>
                              <p class="news__text__page">'.$row["news_text"].'</p>';
                    }
                ?>
            
            </div>
        </div>
    </section>
</body>
</html>