
const sound_cheked = document.querySelector('#chat-sound-check');
const sound_btn = document.querySelector('.chat-sound-btn');
const sound_popUp_block = document.querySelector('.chat-sound-popUp');
const token_ChatSound = document.querySelector('.token-ChatSound');

function soundSetting(e) {
    sound_popUp_block.classList.remove('disible')
    sound_popUp_block.classList.add('active')
    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', '../soundSetting.php');
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    if (sound_cheked.checked) {
        checked = '1'
    }
    else {
        checked = '0'
      
    }  
    xhttp.send(`SoundChecked=${checked} & name=${e.currentTarget.innerHTML} & token=${token_ChatSound.value}`);
    xhttp.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {
console.log(this.response);
        }
    }
}

sound_btn.onclick = function (){
    sound_popUp_block.classList.remove('active')
    sound_popUp_block.classList.add('disible')


}