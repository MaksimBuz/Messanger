

//Форма регистрации
const btn_register = document.querySelector('.btn-signup');
const form_register = document.querySelector('.form-register');
const user_email = document.querySelector('#email');
const user_nickname = document.querySelector('#nickname');
const user_pass = document.querySelector('#pass');
const tocken_register = document.querySelector('.token-register');

const setting_btn = document.querySelector('.profile-setting-btn');
const popUp_profile_settings = document.querySelector('.popUp-profile-settings');

//Форма Авторизации
const btn_auth = document.querySelector('.btn-auth');
const user_email_auth = document.querySelector('#email_auth');
const user_pass_auth = document.querySelector('#pass_auth');
const tocken_auth = document.querySelector('.token-auth');

// Профиль
const profile = document.querySelector('.popUp-profile');
const profile_block = document.querySelector('.popUp-profile-block');
const profile_btn = document.querySelector('.profile-btn');


// Груповые чаты
const GroupChatBlock = document.querySelector('.left-bottom-block');
const GroupChatpopup = document.querySelector('.popUp-GroupChat-create ');
const groupChatName = document.querySelector('#groupChat-name');
const groupChatMembers = document.querySelector('#groupChat-members');
const groupChatBtn = document.querySelector('.createChat-btn');
const groupChatPopUpBtn = document.querySelector('.chat-create');

// Кнопка выйти
const exit_auth = document.querySelector('.exit-btn');


// Остальное
const User_list = document.querySelector('.User-list');
const Msg_list = document.querySelector('.center-msg-block');
const msgInput = document.querySelector('.user-msg');


// регистрация
btn_register.addEventListener('click', (e) => {
    e.preventDefault();
    let xhttp = new XMLHttpRequest();
    xhttp.open('post', 'register.php', true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    console.log(tocken_register.value)
    xhttp.send(`user_email=${user_email.value} & user_nickname=${user_nickname.value} & token=${tocken_register.value} `);

    xhttp.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {

        }
    }

});


// Авторизация
btn_auth.addEventListener('click', (e) => {
    e.preventDefault();
    User_list.innerHTML = ''
    getGroupChat()
    // Отсылаем данные на авторизацию пользователя
    let xhttp = new XMLHttpRequest();
    xhttp.open('post', 'authorization.php', true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(`user_email_auth=${user_email_auth.value}  & user_pass_auth=${user_pass_auth.value} & token=${tocken_auth.value}`);
    xhttp.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {
            form_register.classList.add('disible')
            console.log(this.response)

        }
    }

    // Получаем список друзей
    let xhttpFriends = new XMLHttpRequest();
    xhttpFriends.open('GET', 'getUserFriends.php');
    xhttpFriends.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttpFriends.send(` `);
    xhttpFriends.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4 && xhttpFriends.response) {
            try {
                // Выводим список друзей пользователя
                const objFriendItem = JSON.parse(xhttpFriends.response);
                for (let key in objFriendItem) {
                    let UserItem = document.createElement("li");
                    let UserItemText = document.createElement("p");
                    UserItemText.innerHTML = objFriendItem[key];
                    UserItemText.classList.add('list-item-text')
                    UserItem.classList.add('friend-list-item')
                    UserItem.append(UserItemText);
                    User_list.append(UserItem);

                    let UserImg = document.createElement("img");
                    UserImg.classList.add('UserImg')
                    UserImg.src = './img/' + key;
                    UserItem.append(UserImg);
                }


                // При клике получаем текст из элемента списка друзей
                const Friends_list = document.querySelectorAll('.list-item-text');

                Friends_list.forEach(element => {4
                    element.addEventListener('contextmenu',(e) =>soundSetting(e))
                    element.addEventListener('click', (e) => {
                        let xhttpSendMsg = new XMLHttpRequest();
                        xhttpSendMsg.open('POST', 'sendUserMsg.php');
                        xhttpSendMsg.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                        //    Если ничего строка пустая
                        if (msgInput.value == '') {
                            console.log('Строка пустая')
                        }
                        // Мы отсылаем имя получаетеля и само сообшение
                        else {
                            xhttpSendMsg.send(`recepientName=${e.currentTarget.innerHTML}  & MsgText=${msgInput.value} `);
                        }
                        xhttpSendMsg.onreadystatechange = function () {
                            if (this.status == 200 && this.readyState == 4) {
                                console.log(this.response)
                            }

                        }

                        let xhttpMessage = new XMLHttpRequest();
                        xhttpMessage.open('POST', 'getMessage.php');
                        xhttpMessage.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    
                        xhttpMessage.send(`user_name=${e.currentTarget.innerHTML} `);
                        xhttpMessage.onreadystatechange = function () {
                            // ПОлучаем сообшения от друга
                            if (this.status == 200 && this.readyState == 4) {
                                const objFriendMsg = JSON.parse(xhttpMessage.response);
                                MsgAll=JSON.parse( objFriendMsg[0]);
                                // ЧИстим блок  сообшений от других пользователей
                                Msg_list.innerHTML = ''
                                msgInput.value = ''
                                MsgAll.forEach(element => {
                                    // Выводим все сообшения
                                    let MsgItem = document.createElement("p");
                                    MsgItem.innerHTML = element['text']
                                    MsgItem.id = element['id']
                                    MsgItem.classList.add('msg-block-item')
                                    Msg_list.append(MsgItem);

                                });
                                if (objFriendMsg[1]==0) { 
                                    element.classList.remove('MsgSound-active')
                                    element.classList.add('MsgSound-disable')
                                    beep2()
                                }
                                else{
                                    element.classList.remove('MsgSound-disable')
                                    element.classList.add('MsgSound-active')
                                }
                                // Вешаем на все сообшения обработчик по клику
                                const UserMsg = document.querySelectorAll('.msg-block-item');
                                UserMsg.forEach(element => {
                                    element.addEventListener('click', e => SettingMsg(e))

                                })
                            }
                        }
                    })
                })

            }
            catch (error) {

            }


        }

    }
});

// Открытие создания чата
groupChatPopUpBtn.addEventListener('click', () => {
    console.log(111)
    GroupChatpopup.classList.toggle('active')
    GroupChatpopup.classList.toggle('disible')
})

// // Профиль
profile_btn.addEventListener('click', ()=> GetProfile())

// // Для попап настройки профиля
setting_btn.addEventListener('click', (e) => {
    popUp_profile_settings.classList.toggle('active')
    popUp_profile_settings.classList.toggle('disible')

})
