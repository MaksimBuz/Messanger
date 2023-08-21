// Настройка профиля
const error_test = document.querySelector('#error_name_add');
const profile_setting_btn = document.querySelector('.setting-btn');
const new_nickname = document.querySelector('#new-nickname');
const new_img = document.querySelector('#new-img');
const tocken = document.querySelector('.token-profile-setting');
const check_nickname = document.querySelector('#check-nickname');
// Настройка профиля
profile_setting_btn.addEventListener('click', (e) => {
    e.preventDefault();
    let xhttp = new XMLHttpRequest();
    xhttp.open('post', 'settingProfile.php', true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    if (new_img.files[0]) {
        Userimg = new_img.files[0].name;

    }

    else {
        Userimg = 'defolt.jpg';

    }

    if (check_nickname.checked) {
        checked = '1'


    }
    else {
        checked = '0'

    }
    xhttp.send(`new_img=${Userimg}  & new-nickname=${new_nickname.value} & check-nickname=${checked} & token=${tocken.value}`);
    xhttp.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {
           
            error_test.innerHTML = this.response
        
           

        }
    }

});

