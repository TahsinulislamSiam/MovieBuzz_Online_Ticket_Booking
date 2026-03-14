const userBtn = document.querySelector('#user-btn');
userBtn.addEventListener('click',function(){
    const userBox = document.querySelector('.profile');
    userBox.classList.toggle('active')
})

const toggle =  document.querySelector('#menu-btn');
toggle.addEventListener('click',function(){
    const navbar = document.querySelector('.navbar');
    navbar.classList.toggle('active');
})


let searchForm = document.querySelector('.header .flex .search_form');
document.querySelector('#search_btn').onclick = () =>{
    searchForm.classList.toggle('active');
const profile = document.querySelector('.profile');
    profile.classList.remove('active');
}