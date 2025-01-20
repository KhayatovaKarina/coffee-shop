<?
    // Запуск сессии
    session_start();
    // Подключение БД
    include "db.php";

    $phone_number = htmlspecialchars($_POST['phone_number']);
    $person_count = htmlspecialchars($_POST['person_count']);
    $date = htmlspecialchars($_POST['date']);
    $time = htmlspecialchars($_POST['time']);

     // Проверка данных
     if($phone_number === '' || $person_count === '' || $date === '' || $time === ''){
        $_SESSION['reservation_message'] = 'Заполните поля';
    }else if(!preg_match("/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/", $phone_number)){
        $_SESSION['reservation_message'] = 'Введите номер телефона в формате +7(000)000-00-00';
    }else{
        // Запрос на добавление данных в БД
        $query = $pdo->prepare('INSERT INTO `booking`(`phone_number`, `person_count`, `date`, `time`) VALUES (?,?,?,?)');
        $query->execute([$phone_number, $person_count, $date, $time]);
        $_SESSION['reservation_message'] = 'Отправлено. Скоро Вам напишут';
    }       
    header('Location: ../../index.php#section-reservation'); 