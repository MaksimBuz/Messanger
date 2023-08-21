
// Профиль

function GetProfile(e) {
    
    let xhttpImg = new XMLHttpRequest();
    xhttpImg.open('post', '../getUserImg.php', true);
    xhttpImg.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttpImg.send(` `);
    xhttpImg.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {
            // Добавляем картинку лиш раз
            profile_block.innerHTML = ''
            let UserImg = document.createElement("img");
            response = this.response
            UserImg.src = 'img/' + this.response
            profile_block.append(UserImg);


        }
    }


    let xhttp = new XMLHttpRequest();
    xhttp.open('post', '../getUserName.php', true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(` `);
    xhttp.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {

            // Добавляем имя лиш раз
            let UserName = document.createElement("p");
            UserName.innerHTML = this.response;
            profile_block.append(UserName);


        }
    }

    profile.classList.toggle('active')
    profile.classList.toggle('disible')
};