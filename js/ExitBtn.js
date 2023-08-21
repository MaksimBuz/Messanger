

exit_auth.addEventListener('click', (e) => {
    // Отправляем запрос на удаление куки
    let xhttpImg = new XMLHttpRequest();
    xhttpImg.open('post', '../exitUser.php', true);
    xhttpImg.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttpImg.send(` `);
    xhttpImg.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {
            console.log(this.response);
            // Чистим список друзей
            User_list.innerHTML = '';
            GroupChatBlock.innerHTML = '';
            // показываем форму регистрации
            form_register.classList.remove('disible')
            form_register.classList.add('active')


        }

    }
})