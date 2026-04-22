const userBtn = document.querySelector('#user-btn');

if(userBtn){
    userBtn.addEventListener('click', function(){
        const userBox = document.querySelector('#header-profile');
        userBox.classList.toggle('active');
    });
}

const toggle = document.querySelector('.toggle-btn');

if(toggle){
    toggle.addEventListener('click', function(){
        const sidebar = document.querySelector('.sidebar');
        sidebar.classList.toggle('active');
    });
}