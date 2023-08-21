const tocken_createGroupChat = document.querySelector('.token-register');

// Функция создания групового чата
groupChatBtn.onclick = function () {

    let xhttGetGroupChat = new XMLHttpRequest();
    xhttGetGroupChat.open('POST', 'createGroupChat.php');
    xhttGetGroupChat.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttGetGroupChat.send(` ChatName=${groupChatName.value} & ChatMembers=${groupChatMembers.value} & token=${tocken_createGroupChat.value}`);
    xhttGetGroupChat.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {
            console.log(this.response)
            GroupChatpopup.classList.remove('active')
            GroupChatpopup.classList.add('disible')

        }
    }

}