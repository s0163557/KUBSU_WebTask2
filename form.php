<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WebBack4</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>

<?php
if (!empty($messages)) {
  print('<div id="messages">');
  // Выводим все сообщения.
  foreach ($messages as $message) {
    print($message);
  }
  print('</div>');
}

// Далее выводим форму отмечая элементы с ошибками классом error
// и задавая начальные значения элементов ранее сохраненными.
?>
    <div class="FormBlock">
        <form method="POST" id="form">
            <label>
                Имя:<br />
                <input type=text name="field-name" placeholder="Иван Иванов" <?php if ($errors['fio']) {print 'class="error"';} ?> value="<?php print $values['fio']; ?>"/>
            </label><br />
            <label>
                Поле email:<br />
                <input name="field-email" placeholder="gav@chtoto.com" type="email" <?php if ($errors['email']) {print 'class="error"';} ?> value="<?php print $values['email']; ?>">
            </label><br />
            <label>
                Дата рождения:<br />
                <input name="field-date" type="date" <?php if ($errors['date']) {print 'class="error"';} ?> value="<?php print $values['date']; ?>"/>
            </label><br />
            <div <?php if ($errors['gender']) {print 'class="error"';} ?>>
            <label>Пол:</label><br />
            <label ><input type="radio"  name="radio-gender" value=1 <?php if ($values['gender']=='1') {print 'checked';}?> />
                Мужской</label>
            <label ><input type="radio" name="radio-gender" value=2 <?php if ($values['gender']=='2') {print 'checked';}?>/>
                Женский</label><br />
            </div>
            <div <?php if ($errors['limbs']) {print 'class="error"';} ?>>
            <label>Кол-во конечностей:</label><br />
            <label ><input type="radio" name="radio-limb" value=5 <?php if ($values['limbs']=='5') {print 'checked';}?> />
                0</label>
            <label ><input type="radio" name="radio-limb" value=1 <?php if ($values['limbs']=='1') {print 'checked';}?>/>
                1</label>
            <label ><input type="radio" name="radio-limb" value=2 <?php if ($values['limbs']=='2') {print 'checked';}?>/>
                2</label>
            <label ><input type="radio" name="radio-limb" value=3 <?php if ($values['limbs']=='3') {print 'checked';}?>/>
                3</label>
            <label ><input type="radio" name="radio-limb" value=4 <?php if ($values['limbs']=='4') {print 'checked';}?>/>
                4</label><br />
            </div>

            <label>
                <div <?php if ($errors['album']) {print 'class="error"';} ?>> Ваши альбомы:<br /> </div>
                <select multiple="multiple" name="superpower[]">
                    <option value=1 <?php if ($values['album']['1']=='1' || $values['album']['2']=='1' || $values['album']['3']=='1' || $values['album']['4']=='1') {print 'selected';} ?>>Blessed & Possessed</option>
                    <option value=2 <?php if ($values['album']['1']=='2' || $values['album']['2']=='2' || $values['album']['3']=='2' || $values['album']['4']=='2') {print 'selected';} ?>>The Sacrament of Sin</option>
                    <option value=3 <?php if ($values['album']['1']=='3' || $values['album']['2']=='3' || $values['album']['3']=='3' || $values['album']['4']=='3') {print 'selected';} ?>>Lupus Dei</option>
                    <option value=4 <?php if ($values['album']['1']=='4' || $values['album']['2']=='4' || $values['album']['3']=='4' || $values['album']['4']=='4') {print 'selected';} ?>>Sacrament of sin</option>
                </select>
            </label><br />

            <label>
                Биография:<br />
                <textarea name="BIO" placeholder="Расскажите о себе"> <?php print $values['bio'];?> </textarea>
                <br />
            </label>
            <label <?php if ($errors['check']) {print 'class="error"';} ?>>
                <input name="ch" type="checkbox" <?php if ($values['check']) {print 'checked';}?>> Ознакомлен с контрактом.<br />
            </label>
            <input type="submit" value="Отправить" />
        </form>
    </div>
</body>
</html>
