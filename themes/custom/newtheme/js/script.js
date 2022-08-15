const toggler = document.getElementById('toggler');
const toggle = document.getElementById('toggle');

const mode = localStorage.getItem('mode');
const darkMode = document.documentElement

if(mode == 'dark') {
    darkMode.classList.add('dark');
}

let myScript = function(){
    const mode = localStorage.getItem('mode');
    const darkMode = document.documentElement

    if(mode == 'dark'){
        localStorage.setItem('mode', 'light');
        darkMode.classList.remove('dark');
    }
    if(mode == 'light'){
        localStorage.setItem('mode', 'dark');
        darkMode.classList.add('dark');
    }
}

toggler.addEventListener("click", myScript);


const modal = document.getElementById('simpleModal');
const modalBtn = document.getElementById('modalBtn');

modalBtn.addEventListener('click', openModal);
window.addEventListener('click', clickOutside);

function openModal(e){
    e.preventDefault();
    modal.classList.remove('hidden');
    modal.classList.add('block');
}

function clickOutside(e){
    if(e.target == modal){
        modal.classList.remove('block');
        modal.classList.add('hidden');
    }
}