<?php
// Отправляем браузеру правильную кодировку,
// файл index.php должен быть в кодировке UTF-8 без BOM.
header('Content-Type: text/html; charset=UTF-8'); 

// В суперглобальном массиве $_SERVER PHP сохраняет некторые заголовки запроса HTTP
// и другие сведения о клиненте и сервере, например метод текущего запроса $_SERVER['REQUEST_METHOD'].
if ($_SERVER['REQUEST_METHOD'] == 'GET') {    
    // Массив для временного хранения сообщений пользователю.
  $messages = array();
  //error_reporting(E_ALL & ~E_NOTICE);
  // В суперглобальном массиве $_COOKIE PHP хранит все имена и значения куки текущего запроса.
  // Выдаем сообщение об успешном сохранении.
  if (!empty($_COOKIE['save'])) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('save', '', 100000);
    // Если есть параметр save, то выводим сообщение пользователю.
    $messages[] = 'Спасибо, результаты сохранены.';
  }
    
    // Складываем признак ошибок в массив.
    $errors = array();
    $errors['fio'] = !empty($_COOKIE['fio_error']);
    $errors['email'] = !empty($_COOKIE['email_error']);
    $errors['date'] = !empty($_COOKIE['date_error']);
    $errors['gender'] = !empty($_COOKIE['gender_error']);
    $errors['limbs'] = !empty($_COOKIE['limbs_error']);
    $errors['album'] = !empty($_COOKIE['album_error']);
    $errors['check'] = !empty($_COOKIE['check_error']);
    
    if ($errors['fio']) {
        // Удаляем куку, указывая время устаревания в прошлом.
        setcookie('fio_error', '', 100000);
        // Выводим сообщение.
        $messages[] = '<div class="errorText">Заполните имя - допустимы только буквы латинского алфавита</div>';
      }
      
    if ($errors['email']) {
        // Удаляем куку, указывая время устаревания в прошлом.
        setcookie('email_error', '', 100000);
        // Выводим сообщение.
        $messages[] = '<div class="errorText">Заполните почту - допустимы только буквы латинского алфавита, знаки "." и "@"</div>';
      }

    if ($errors['date']) {
        // Удаляем куку, указывая время устаревания в прошлом.
        setcookie('date_error', '', 100000);
        // Выводим сообщение.
        $messages[] = '<div class="errorText">Выберите дату.</div>';
      }

      if ($errors['gender']) {
        // Удаляем куку, указывая время устаревания в прошлом.
        setcookie('gender_error', '', 100000);
        // Выводим сообщение.
        $messages[] = '<div class="errorText">Выберите пол.</div>';
      }

      if ($errors['limbs']) {
        // Удаляем куку, указывая время устаревания в прошлом.
        setcookie('limbs_error', '', 100000);
        // Выводим сообщение.
        $messages[] = '<div class="errorText">Выберите конечности.</div>';
      }

      if ($errors['album']) {
        // Удаляем куку, указывая время устаревания в прошлом.
        setcookie('album_error', '', 100000);
        // Выводим сообщение.
        $messages[] = '<div class="errorText">Выберите альбом.</div>';
      }

      if ($errors['check']) {
        // Удаляем куку, указывая время устаревания в прошлом.
        setcookie('check_error', '', 100000);
        // Выводим сообщение.
        $messages[] = '<div class="errorText">Согласитесь с чем-нибудь там.</div>';
      }

      // Складываем предыдущие значения полей в массив, если есть.
  $values = array();
  $values['fio'] = empty($_COOKIE['fio_value']) ? '' : $_COOKIE['fio_value'];
  $values['email'] = empty($_COOKIE['email_value']) ? '' : $_COOKIE['email_value'];
  $values['date'] = empty($_COOKIE['date_value']) ? '' : $_COOKIE['date_value'];
  $values['gender'] = empty($_COOKIE['gender_value']) ? '' : $_COOKIE['gender_value'];
  $values['limbs'] = empty($_COOKIE['limbs_value']) ? '' : $_COOKIE['limbs_value'];
  $values['check'] = empty($_COOKIE['check_value']) ? '' : $_COOKIE['check_value'];
  $values['bio'] = empty($_COOKIE['bio_value']) ? '' : $_COOKIE['bio_value'];

  $values['album'] = array();
  $values['album']['1'] = empty($_COOKIE['album1_value']) ? '' : $_COOKIE['album1_value'];
  $values['album']['2'] = empty($_COOKIE['album2_value']) ? '' : $_COOKIE['album2_value'];
  $values['album']['3'] = empty($_COOKIE['album3_value']) ? '' : $_COOKIE['album3_value'];
  $values['album']['4'] = empty($_COOKIE['album4_value']) ? '' : $_COOKIE['album4_value'];

  include('form.php'); // Включаем содержимое файла form.php.
}

// Иначе, если запрос был методом POST, т.е. нужно проверить данные и сохранить их в XML-файл.
else {
    // Проверяем ошибки.
    $errors = FALSE;
    if (!preg_match('/^[a-zA-Z]/' , $_POST['field-name'])) {
      // Выдаем куку на день с флажком об ошибке в поле fio.
      setcookie('fio_error', '1', time() + 24 * 60 * 60);
      $errors['name'] = TRUE;
    }
    else {
      // Сохраняем ранее введенное в форму значение на месяц.
      setcookie('fio_value', $_POST['field-name'], time() + 30 * 24 * 60 * 60);
    }
  
    if (!preg_match('/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/', $_POST['field-email'])) {
      // Выдаем куку на день с флажком об ошибке в поле fio.
      setcookie('email_error', '1', time() + 24 * 60 * 60);
      $errors['email'] = TRUE;
    }
    else {
      // Сохраняем ранее введенное в форму значение на месяц.
      setcookie('email_value', $_POST['field-email'], time() + 30 * 24 * 60 * 60);
    }

    if (empty($_POST['field-date'])) {
      // Выдаем куку на день с флажком об ошибке в поле fio.
      setcookie('date_error', '1', time() + 24 * 60 * 60);
      $errors['date'] = TRUE;
    }
    else {
      // Сохраняем ранее введенное в форму значение на месяц.
      setcookie('date_value', $_POST['field-date'], time() + 30 * 24 * 60 * 60);
    }

    if (empty($_POST['radio-gender'])) {
      // Выдаем куку на день с флажком об ошибке в поле fio.
      setcookie('gender_error', '1', time() + 24 * 60 * 60);
      $errors['gender'] = TRUE;
    }
    else {
      // Сохраняем ранее введенное в форму значение на месяц.
      setcookie('gender_value', $_POST['radio-gender'], time() + 30 * 24 * 60 * 60);
    }

    if (empty($_POST['radio-limb'])) {
      // Выдаем куку на день с флажком об ошибке в поле fio.
      setcookie('limbs_error', '1', time() + 24 * 60 * 60);
      $errors['limbs'] = TRUE;
    }
    else {
      // Сохраняем ранее введенное в форму значение на месяц.
      setcookie('limbs_value', $_POST['radio-limb'], time() + 30 * 24 * 60 * 60);
    }

    if (empty($_POST['superpower'])) {
      // Выдаем куку на день с флажком об ошибке в поле fio.
      setcookie('album_error', '1', time() + 24 * 60 * 60);
      $errors['album'] = TRUE;
    }
    else {
      // Сохраняем ранее введенное в форму значение на месяц.
      $superpower = $_POST['superpower'];
      setcookie('album1_value', $superpower['0'], time() + 30 * 24 * 60 * 60);
      setcookie('album2_value', $superpower['1'], time() + 30 * 24 * 60 * 60);
      setcookie('album3_value', $superpower['2'], time() + 30 * 24 * 60 * 60);
      setcookie('album4_value', $superpower['3'], time() + 30 * 24 * 60 * 60);
    }

    if (!isset($_POST['ch'])) {
      // Выдаем куку на день с флажком об ошибке в поле fio.
      setcookie('check_error', '1', time() + 24 * 60 * 60);
      setcookie('check_value', FALSE, time() + 30 * 24 * 60 * 60);
      $errors['check'] = TRUE;
    }
    else {
      // Сохраняем ранее введенное в форму значение на месяц.
      setcookie('check_value', $_POST['ch'], time() + 30 * 24 * 60 * 60);
    }

    setcookie('bio_value', $_POST['BIO'], time() + 30 * 24 * 60 * 60);

    if ($errors) {
      // При наличии ошибок перезагружаем страницу и завершаем работу скрипта.
      header('Location: index.php');
      exit();
    }
    else {
      // Удаляем Cookies с признаками ошибок.
      setcookie('fio_error', '', 100000);
      setcookie('email_error', '', 100000);
      setcookie('data_error', '', 100000);
      setcookie('gender_error', '', 100000);
      setcookie('limbs_error', '', 100000);
      setcookie('album_error', '', 100000);
      setcookie('check_error', '', 100000);
    }

    // Сохраняем куку с признаком успешного сохранения.
    setcookie('save', '1');
    header('Location: index.php');
    exit();
  }

$DBlog = 'u41797';
$DBpas = '6849699';

//Представляет собой соединение между PHP и сервером базы данных.
$conn = new PDO("mysql:host=localhost;dbname=u41797", $DBlog, $DBpas, array(PDO::ATTR_PERSISTENT => true));

  try{
//Объединяет элементы массива в строку
$sup= implode(', ', (array)$_POST['superpower']);

//Подготавливает инструкцию к выполнению и возвращает объект инструкции
$user = $conn->prepare("INSERT INTO form SET name = ?, email = ?, dob = ?, gender = ?, limbs = ?, bio = ?, che = ?");

//Запускает подготовленный запрос на выполнение
$user -> execute(array($_POST['field-name'], $_POST['field-email'], date('Y-m-d', strtotime($_POST['field-date'])), $_POST['radio-gender'], $_POST['radio-limb'], $_POST['BIO'], $_POST['ch']));
$id_user = $conn->lastInsertId();

$user1 = $conn->prepare("INSERT INTO album SET id = ?, super_name = ?");
$user1 -> execute([$id_user, $sup]);
}

  catch(PDOException $e){
    print( 'Error : ' . $e->getMessage());
    include('form.php');
    exit();
  }
