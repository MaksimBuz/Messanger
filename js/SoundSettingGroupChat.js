// Получаем значение чекбокса
const chat_sound = document.querySelector('#chat-sound');
const popUp_Groupchat_sound = document.querySelector('.popUp-chat-sound');
const Groupchat_sound_btn = document.querySelector('.Groupchat-sound-btn');

const tocken_sound = document.querySelector('.token-groupChatSound');
function SoundSettingGroupChat(e) {

    popUp_Groupchat_sound.classList.remove('disible')
    popUp_Groupchat_sound.classList.add('active')

    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', '../settingSoundGroupChat.php');
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    if (chat_sound.checked) {
        checked = '1';
    }
    else {
        checked = '0'
       
    } 
    xhttp.send(`SoundChecked=${checked} & ChatId=${e.currentTarget.id}  & token=${tocken_sound.value}`);
    xhttp.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {
console.log(this.response)
        }
    }
}

Groupchat_sound_btn.onclick = function (){
    popUp_Groupchat_sound.classList.remove('active')
    popUp_Groupchat_sound.classList.add('disible')


}