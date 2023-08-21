// Настройка сообшений
const popUp_msg_settings = document.querySelector('.popUp-msg-settings');
const msgDeleteBtn = document.querySelector('.Delete-msg-btn');
const msgUpdateBtn = document.querySelector('.Update-msg-btn');
const msgForwardBtn = document.querySelector('.forward-msg-btn');
const recipient_email = document.querySelector('#recipient-email');
const newMsgtext = document.querySelector('.new-msg-text');
const tocken_settingMsg = document.querySelector('.token-settingMsg');


// Сама функция на обработку сообшений
function SettingMsg(e) {
    // Открытие окна с настройками
    popUp_msg_settings.classList.add('active')
    popUp_msg_settings.classList.remove('disible')

    // Если хотим удалить сообшение
    msgDeleteBtn.onclick = function () {
        // Отправляю запрос на удаление
        let xhttpMessageDelete = new XMLHttpRequest();
        xhttpMessageDelete.open('POST', 'deleteMsg.php');
        xhttpMessageDelete.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        // Посылаем айди сообшения и удаляем его
        xhttpMessageDelete.send(`msgId=${e.target.id} & token=${tocken_settingMsg.value} `);
        xhttpMessageDelete.onreadystatechange = function () {
            if (this.status == 200 && this.readyState == 4) {
                popUp_msg_settings.classList.remove('active')
                popUp_msg_settings.classList.add('disible')
            }
        }
    }

    // Если хотим изменить  сообшение
    msgUpdateBtn.onclick = function (params) {
        const newMsgtext = document.querySelector('#new-msg-text');
        // Отправляю запрос на изменение
        let xhttpMessageUpdate = new XMLHttpRequest();
        xhttpMessageUpdate.open('POST', 'updateMsg.php');
        xhttpMessageUpdate.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        // Посылаем айди сообшения и текст нового сообшения 
        xhttpMessageUpdate.send(`msgId=${e.target.id} & newMsgtext=${newMsgtext.value}  & token=${tocken_settingMsg.value}`);
        xhttpMessageUpdate.onreadystatechange = function () {
            if (this.status == 200 && this.readyState == 4) {
                popUp_msg_settings.classList.remove('active')
                popUp_msg_settings.classList.add('disible')
            }
        }

    }

    // Если хотим переслать сообшение
    msgForwardBtn.onclick = function () {
        // Отправляю запрос на пересылку
        let xhttpMessageForward = new XMLHttpRequest();
        xhttpMessageForward.open('POST', '../forwardMsg.php');
        xhttpMessageForward.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        // Посылаем айди сообшения и емаил получателя
        xhttpMessageForward.send(`msgId=${e.target.id} & recipientEmail=${recipient_email.value} & token=${tocken_settingMsg.value}`);
        xhttpMessageForward.onreadystatechange = function () {
            if (this.status == 200 && this.readyState == 4) {
                console.log(this.response);
                popUp_msg_settings.classList.remove('active')
                popUp_msg_settings.classList.add('disible')
            }
        }
    }

}