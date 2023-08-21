<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messanger</title>
    <link rel="stylesheet" href="style.css">
</head>
<body> 


<?php
session_start();
$token = hash('gost-crypto', random_int(0, 999999));
$_SESSION["CSRF"] = $token;
?>

<!-- Должна быть скрыта если пользователь зарегестрирован -->
<div class="form-register ">
   <h1>Форма регистрации </h1>
        <input  type="email" id="email" name="email" placeholder="email" required><br />
        <input type="text" id="nickname" name="nickname" placeholder="nickname" required><br />
        <input type="password"id="pass" name="pass" placeholder="пароль" required> <br />
        <input type="hidden" class="token-register"name="token" value="<?= $token ?>"> <br />
        <input class="btn-signup" type="submit" value="Зарегестрироваться">
</div>
<!-- Должна быть скрыта если пользователь зарегестрирован -->
<div class="form-auth">
<h1>Форма авторизации</h1>
    <input  type="email" id="email_auth" name="email_auth" placeholder="email" required><br />
    <input type="password" id="pass_auth" name="pass_auth" placeholder="пароль" required> <br />
    <input type="hidden" class="token-auth" name="token" value="<?= $token ?>"> <br />
    <input class="btn-auth" type="submit" value="Войти">
</div>
    <div class="main-wrapper">
        <div class="left-block">
            <div class="left-top-block">
               <p>список контактов</p> 
                <ul class="User-list">        
                </ul>
            </div>
            <div class="left-bottom-block">
                <p class="left-bottom-text">
                    Групповой чат 123
                </p>
            </div>
        </div>
        <div class="center-block">
            <p class="center-text"> Чат с пользователем :</p>
            <div class="center-msg-block">
            </div>
            <div class="user-msg-form">
                <input type="text" class="user-msg" placeholder="Наберите Ваше сообщение здесь">
                <button type="submit" id="msgSubmit"><img src="./image 5.svg" alt="" class="mail-img"></button>
            </div>   
        </div>
        <div class="right-block">
            <ul class="right-list">
                <li  class="right-list-item profile-btn" id="profile"> Профиль</li>
                <li class="right-list-item profile-setting-btn">Настройки</li>
                <li class="right-list-item chat-create">Создать группу</li>
                <li class="right-list-item exit-btn">Выйти</li>
            </ul>
        </div>
    </div> 
<!-- Профиль -->
    <div class="popUp-profile disible">
        <div class="popUp-profile-block">
            
        </div>
    </div> 

    <!-- Настройка профиля -->
    <div class="popUp-profile-settings disible">
        <form action="./settingProfile.php" method="post" enctype="multipart/form-data">
            <input type='file' id="new-img" name="file"  ><br>
            <input type="text" id="new-nickname" name="new-nickname"placeholder="Новый nickname"  required>
            <div>
                <p id="error_name_add"></p>
              <input type="checkbox" id="check-nickname" name="check-nickname" />
            <label for="nickname">Скрыть nickname</label>  
            </div>
            <input type="hidden" class="token-profile-setting" name="token" value="<?= $token ?>"> <br />
            <input type='submit'  value='Загрузить' class="submit setting-btn">
        </form>
    </div>

 <!-- Создать групповой чат -->
 <div class="popUp-GroupChat-create disible">
    <div class="GroupChat-create-form">
    <p>Название</p>
    <input type="text"  id="groupChat-name"placeholder="Название чата" >
    <p>Участники</p>
    <input type="text"  id="groupChat-members"placeholder="Емаилы участников через запятую" >
    <input type="hidden" class="token-createGroupchat" name="token" value="<?= $token ?>"> <br />
    <input type='submit'  value='создать' class="submit createChat-btn">
    </div> 
</div> 


<!-- Настройка сообшений -->
<div class="popUp-msg-settings disible">
    <div class="msg-settings-form">
        <input type="text"  id="new-msg-text"placeholder="Новый текст сообшения" >
        <input class="Update-msg-btn" type="submit" value="Изменить">
        <p>Переслать</p>
        <input type="text" id="recipient-email" placeholder="Никнейм получателя" > 
        <input type="hidden" class="token-settingMsg" name="token" value="<?= $token ?>"> <br /> 
        <input class="forward-msg-btn" type="submit" value="переслать">
        <input class="Delete-msg-btn" type="submit" value="Удалить">
    </div> 
</div> 

<!-- Отключение оповещение групповых чатов -->
<div class="popUp-chat-sound disible">
    <div class="msg-sound-form">
        <input type="checkbox" id="chat-sound" name="chat-sound" />
        <label for="chat-sound">Включить/Отключить оповещения группового чат</label>
        <input type="hidden" class="token-groupChatSound" name="token" value="<?= $token ?>"> <br /> 
        <input class="Groupchat-sound-btn" type="submit" value="закрыть">
    </div> 
</div> 

<!-- Отключение оповещение -->
<div class="chat-sound-popUp disible">
    <div class="msg-sound-form ">
        <input type="checkbox" id="chat-sound-check" name="chat-sound" />
        <label for="chat-sound">Включить/Отключить оповещения</label>
        <input type="hidden" class="token-ChatSound" name="token" value="<?= $token ?>"> <br /> 
        <input class="chat-sound-btn" type="submit" value="закрыть">
    </div> 

</div> 
    <script src="./script.js"></script>
    <script src="./js/GetMessage.js"></script>
    <script src="./js/SettingMsg.js"></script>
    <script src="./js/getGroupChat.js"></script>
    <script src="./js/SendMessageGroupChat.js"></script>
    <script src="./js/SoundSettingGroupChat.js"></script>
    <script src="./js/SettingProfile.js"></script>
    <script src="./js/soundSetting.js"></script>
    <script src="./js/ExitBtn.js"></script>
    <script src="./js/Getprofile.js"></script>
    <script src="./js/CreateGroupChat.js"></script>
 
</body>
</html>