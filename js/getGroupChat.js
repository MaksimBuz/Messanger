// Функция получения списка чатов
function getGroupChat(params) {
    GroupChatBlock.innerHTML=''
    let xhttGetGroupChat = new XMLHttpRequest();
    xhttGetGroupChat.open('POST', '../getGroupChatAll.php');
    xhttGetGroupChat.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttGetGroupChat.send(` `);
    xhttGetGroupChat.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {
            const objGroupList = JSON.parse(xhttGetGroupChat.response);
            for(let key in objGroupList){
                let GroupChatItem = document.createElement("p");
                GroupChatItem.innerHTML = objGroupList[key]
                GroupChatItem.classList.add('left-bottom-text')
                GroupChatItem.id=key
                GroupChatBlock.append(GroupChatItem);

            }
            const GroupCHatItem = document.querySelectorAll('.left-bottom-text');
            GroupCHatItem.forEach(element => {
                element.addEventListener('click', e => GetMessage(e,element))
                element.addEventListener('click', e => SendMessage(e))
                element.addEventListener('contextmenu', e => SoundSettingGroupChat(e))
            })
        }

    }
}