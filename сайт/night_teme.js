 



function night_teme()
{
    

 const fote = document.querySelector('.about_me');

const nav = document.querySelector('.navbar');
const carusel = document.querySelector('.carusel_col');
const table = document.querySelector('.FTable');
const edu = document.querySelector('.education_H');
const foter = document.querySelector('.footer');
const h1= document.getElementsByTagName('h1');
const h2= document.getElementsByTagName('h2');

h1[0].style.color ='white';
h2[0].style.color ='white';
h2[1].style.color ='white';
h1[0].style.textShadow = 'none'
h2[0].style.textShadow = 'none'
h2[1].style.textShadow = 'none'
nav.classList.remove('navbar-light','bg-light');
nav.classList.add('navbar-dark','bg-dark');
document.body.style.background ='#322e2e';
table.style.color ='white';
edu.style.color ='white';
document.body.style.color ='white';
carusel.style.background='#322e2e';
foter.style.background='#212529';
fote.style.background='#322e2e';
fote.style.color='white';



}   


  



