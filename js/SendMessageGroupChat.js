function SendMessage(e){
    let xhttpSendMsg = new XMLHttpRequest();
    xhttpSendMsg.open('post', '../sendGroupChatMsg.php', true);
    xhttpSendMsg.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
     //    Если ничего строка пустая
     if (msgInput.value == '') {
        console.log('Строка пустая')
    } 
    // Мы отсылаем имя получаетеля и само сообшение
    else {
        xhttpSendMsg.send(`recipientGroupChatId=${e.currentTarget.id}  & MsgText=${msgInput.value} `);
    }
    xhttpSendMsg.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {
            msgInput.value = ''
            console.log(this.response)


        }
    }
}