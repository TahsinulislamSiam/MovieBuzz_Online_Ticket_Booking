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


//home section


"use strict"

const leftArrow = document.querySelector('.left-arrow');
const rightArrow = document.querySelector('.right-arrow');
const slider = document.querySelector('.slider');

function scrollRight(){
    slider.scrollBy({
        left: window.innerWidth,
        behavior: "smooth"
    });
}

function scrollLeft(){
    slider.scrollBy({
        left: -window.innerWidth,
        behavior: "smooth"
    });
}

rightArrow.addEventListener("click", () => {
    scrollRight();
});

leftArrow.addEventListener("click", () => {
    scrollLeft();
});

let timerId = setInterval(scrollRight, 7000);

function resetTimer(){
    clearInterval(timerId);
    timerId = setInterval(scrollRight, 7000);
}





