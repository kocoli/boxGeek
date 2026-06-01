const burger = document.querySelector('#btn-burger');
const sidebar = document.querySelector('#sidebar');
const main = document.querySelector('.container')

burger.addEventListener('click', ()=>{
    sidebar.classList.toggle('close');
    main.classList.toggle('open');
});
