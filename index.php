<? // Подключение БД
include("apps/php/db.php");
// Запуск сессии
session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffeee shop</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Icons+Outlined">
    <link rel="stylesheet" href="smartbasket/css/smartbasket.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header id="header-section">
        <div class="container container-header">
            <div class="header">
                <nav class="nav-main">
                    <ul class="nav-main__list">
                        <li class="nav-main__item">
                            <a class="nav-main__link nav-main__link_selected" href="#banner-section">Главная</a>
                        </li>
                        <li class="nav-main__item">
                            <a class="nav-main__link" href="#menu-section">Меню</a>
                        </li>
                        <li class="nav-main__item">
                            <a class="nav-main__link" href="#section-reservation">Бронирование</a>
                        </li>
                    </ul>
                    <img class="header__logo" src="img/logo.svg" alt="#">
                    <ul class="nav-main__list">

                        <li class="nav-main__item">
                            <a class="nav-main__link" href="catalog.php">Магазин</a>
                        </li>
                    </ul>
                </nav>
                   
                <input type="text" id="searchInput" class="header-action__search-input" size="15">
                <button id="search-btn" class="header-action__search material-icons-outlined">search</button>                        

                <!-- Корзина -->
                <div id="section-cart" class="section-cart"></div>
              
            </div>
        </div>
    </header>

    <main>
        <div class="margin-block"></div>
        <section id="banner-section">
            <div class="container">
                <div class="banner">
                    <div class="banner-info">
                        <h2 class="banner__header">Насладись кофе</h2>
                        <p class="banner__text">Мы варим кофе путем обжаривания зеленых кофейных зерен на горячих углях в жаровне</p>
                        <a href="#section-reservation"><button class="banner__btn btn-primary">Попробовать</button></a>
                    </div>
                </div>
            </div>
        </section>

        <section class="container">
            <ol class="features section-main">
                <li class="features__item">
                    <span class="features__item_dark">01</span>Зерна лучшего качества
                    <img class="features__img" src="img/feature-1.jpg" alt="#">
                </li>
                <li class="features__item">
                    <span class="features__item_dark">02</span>Мягкий вкус
                    <img class="features__img" src="img/feature-2.jpg" alt="#">
                </li>
                <li class="features__item">
                    <span class="features__item_dark">03</span>Правильная жарка
                    <img class="features__img" src="img/feature-3.jpg" alt="#">
                </li>
            </ol>
        </section>

        <!-- Меню -->
        <section id="menu-section" class="section-main">
            <div class="container">
                <h2 class="section-title">Меню</h2>
                <h3 class="section-subtitle">Популярное кофе</h3>
                <ul class="menu-wrap">
                <?  $query = $pdo->prepare('SELECT `drink_name`, `drink_price`, `drink_img` FROM `menu`');
                    $query->execute();
                    while ($row = $query->fetch(PDO::FETCH_LAZY)){
                        echo '<li class="menu">
                        <img class="menu__img" src="img/'.$row["drink_img"].'" alt="#">
                        <h3 class="menu__title">'.$row["drink_name"].'</h3>
                        <b class="menu__price">'.$row["drink_price"].' ₽</b>
                    </li>'; 
                    }
                ?>
                </ul>
            </div>
        </section>

        <!-- Популярные товары (зерна) -->
        <section id="popular-section" class="section-main">
            <div class="container">
                <h2 class="section-title">Наши кофейные зерна</h2>
                <h3 class="section-subtitle">Популярные товары</h3>
                <div class="popular-wrap">
                <?  $query = $pdo->prepare('SELECT `product_id`, `product_name`, `product_price`, `product_img` FROM `products` LIMIT 3');
                    $query->execute();
                    while ($row = $query->fetch(PDO::FETCH_LAZY)){
                        echo '<div class="popular">
                        <form data-name="Email Form" id="smart-basket__form" method="post" action="mail.php">
                            <img class="popular__img" src="img/'.$row["product_img"].'" alt="#">
                            <h3 class="popular__title">'.$row["product_name"].'</h3>
                            <div class="product__price"><span class="product__price-number">'.$row["product_price"].'</span> ₽</div>
                            
                            <div class="product__size">
                                <div class="product__size-element" data-sb-curent-price="'.$row["product_price"].'" data-sb-curent-size="400 грамм" data-sb-curent-id-or-vendor-code="04'.$row["product_id"].'">400 грамм</div>
                                <div class="product__size-element" data-sb-curent-price="'.$row["product_price"]*2 .'" data-sb-curent-size="800 грамм" data-sb-curent-id-or-vendor-code="08'.$row["product_id"].'">800 грамм</div>        
                            </div>
                            
                        <div class="product__quantity"></div>
                        </form>
                        <button class="popular__btn" 
                            data-sb-id-or-vendor-code="'.$row["product_id"].'"
                            data-sb-product-name="'.$row["product_name"].'"
                            data-sb-product-price="'.$row["product_price"].'"
                            data-sb-product-quantity="1"
                            data-sb-product-img="img/'.$row["product_img"].'"
                        >В корзину</button>
                        </div>';
                    }

                ?>     
            </div>
            <a class="popular__link btn-primary" href="catalog.php">Каталог</a>
        </section>
        

        <!-- Отзывы -->
        <section id="testimonial-section" class="section-main">
            <div class="container">
                <h2 class="section-title">Отзывы</h2>
                <h3 class="section-subtitle">Мнение наших покупателей</h3>
            </div>
        <script src="https://res.smartwidgets.ru/app.js" defer></script>
        <div class="sw-app" data-app="f7610dfe4a080c58ff30ae1443441750"></div>            
        </section>

        <!-- Бронирование -->
        <section id="section-reservation" class="section-main">
            <div class="container">
                <div class="reservation-wrap">
                    <div class="reservation-map"></div>
                    <form class="reservation" action="apps/php/booking.php" method="post">
                        <h2 class="reservation__title section-title">Бронирование</h2>
                        <h3 class="reservation__subtitle section-subtitle">Забронируйте столик</h3>
                        <input class="reservation__input" type="text" value="Номер телефона" name="phone_number">
                        <input class="reservation__input" type="text" value="2 персоны" name="person_count">
                        <input class="reservation__input" type="text" value="01.01.2025" name="date">
                        <input class="reservation__input" type="text" value="11:00" name="time">

                        <!-- Вывод сообщения -->
                        <?
                            if(isset($_SESSION['reservation_message'])){
                                echo  "<p class='reservation__message'>".$_SESSION['reservation_message']."</p>";
                            }
                            unset($_SESSION['reservation_message']);
                        ?>
                        <button class="reservation__btn btn-primary" type="sybmit">Отправить</button>
                    </form>
                </div>
            </div>
        </section>

        <!-- Новости -->
        <section id="section-news" class="section-main">
            <div class="container">
                <h2 class="section-title">Новости</h2>
                <h3 class="section-subtitle">Последние события</h3>
                <div class="news-wrap">

                <?  $query = $pdo->prepare('SELECT * FROM `news`');
                    $query->execute();
                    while ($row = $query->fetch(PDO::FETCH_LAZY)){
                        echo '<div class="news">
                        <img class="news__img" src="'.$row["news_img"].'" alt="#">
                        <div class="news-description">
                            <div class="news-info">
                                <span class="news__author"><span class="news__author_dark">От: </span>'.$row["news_author"].'</span>
                                <time class="news__date" datetime="2021-01-21">'.$row["news_date"].'</time>
                            </div>
                            <p class="news__text">'.$row["news_caption"].'....</p>
                            <a class="news__link" href="news.php?news_id='.$row["news_id"].'">Подробнее <span class="material-icons-outlined">arrow_forward</span></a>
                        </div>
                    </div>';

                    }
                ?>

                </div>
            </div>
        </section>

        <!-- Подвал -->
         <section> <footer id="footer-section">
            <div class="container">
                <div class="footer">
                    <img class="footer__img" src="img/logo.svg" alt="#">
                    <ul class="footer__list">
                        <li class="footer__item">
                            <a class="footer__link" href="#">Главная</a>
                        </li>
                        <li class="footer__item">
                            <a class="footer__link" href="#">Бронирование</a>
                        </li>
                        <li class="footer__item">
                            <a class="footer__link" href="#">Меню</a>
                        </li>
                        <li class="footer__item">
                            <a class="footer__link" href="#">Магазин</a>
                        </li>
                        <li class="footer__item">
                            <a class="footer__link" href="#">Контакты</a>
                        </li>
                    </ul>

                </div>
            </div>
            <div class="footer-copyright">
                <div class="container">
                    <p class="footer-copyright__text">COFFE SHOP © 2025. Все права защищены</p>
                </div>
            </div>
        </footer></section>
        <div class="smart-basket__wrapper"></div>
    </main>

    <!-- Подключение скриптов -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="apps/js/style.js"></script>
    <script src="./smartbasket/js/smartbasket.min.js"></script>
    <script type="text/javascript" src="apps/js/search.js"></script>

<!-- Подключение виджета корзины -->
	<script>
		$(function () {
			$('.smart-basket__wrapper').smbasket({
				productElement: 'popular',
				buttonAddToBasket: 'popular__btn',
				productPrice: 'product__price-number',
				productSize: 'product__size-element',
				
				productQuantityWrapper: 'product__quantity',
				smartBasketMinArea: 'section-cart',
				countryCode: '+7',
				smartBasketCurrency: '₽',
				smartBasketMinIconPath: 'img/shopping-basket-wight.svg',

				agreement: {
					isRequired: true,
					isChecked: true,
					isLink: 'https://artstranger.ru/privacy.html',
				},
				nameIsRequired: false,
			});
		});
	</script>

<!-- Подключение платежного виджета -->
<script type="text/javascript" src="https://js.overpay.io/widget/be_gateway.js"></script>


<script type="text/javascript">
    this.payment = function() {
        var params ={
            checkout_url: "https://checkout.overpay.io",
            fromWebview: true,
            checkout: {
                iframe: true,
                test: true,
                transaction_type: "payment",
                public_key: "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAn/snoy7QcaMASuXZzcs4X4s88dbjEUqRZ86ym6IJGT9ktNii7KzbV1aL9e6elGkCSESBEMvHdOAQQ405alrxoG0HjNFGxeirgXLWyyn0rtXdagAgiBlr1vsKd6j529TMuo18cA+BwBsrJaM/NPTXL8hOVW3T0/mHp3pJrGo+xGEk5TRyMI79fU2xruLHtv3IqtXVhJ5IRmUwuXIFzUwuM9UjNbsfrrBLCuWRO/FstQRN4kXPP/ZJZBsusgIZmZr6Y70gXjm0yslDZ2tXsIN3nkgouhqYatx1p0xIklbqi3hkhe4I4mqRp4ChbFWEElXFayc5z3cUE67XS7uURBKvzwIDAQAB",
                order: {
                    amount: 100,
                    currency: "EUR",
                    description: "Payment description",
                    tracking_id: "my_transaction_id"
                },
            },
            closeWidget: function(status) {
              // возможные значения status
              // successful - операция успешна
              // failed - операция не успешна
              // pending - ожидаем результат/подтверждение операции
              // redirected - пользователь отправлен на внешнюю платежную систему
              // error - ошибка (в параметрах/сети и тд)
              // null - виджет закрыли без запуска оплаты
              console.debug('close widget callback')
            }
        };

        new BeGateway(params).createWidget();
    };
</script>

</body>
</html>