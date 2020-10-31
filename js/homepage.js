document.addEventListener('DOMContentLoaded', () => {

    console.log('index.html is loaded');

    /**************************************************HOMEPAGE********************************************/

    const main = document.getElementById('main');
    const section = document.getElementById('section');
    const choose = document.getElementById('choose'); 
    const chooseBtn = document.getElementById('chosenBtn');
    const startBtn = document.getElementById('start-btn');

    if(main){  
            if(localStorage.getItem('chosenColor') === null){
                main.classList.add('hide');
                section.classList.add('hide');
        
            }else if(localStorage.getItem('chosenColor')){
                choose.classList.add('hide');
                main.classList.remove('hide');
                section.classList.remove('hide');
                
            }
        
            chooseBtn.addEventListener('click', () => {
                location.reload();
            })

        }
    
    // index -> choose-category.php
    if(startBtn){
        startBtn.addEventListener('click', () => {
            location.href = 'choose-category.php';
        })
    }

    const alerted = localStorage.getItem('alerted') || '';
        if(alerted !== 'yes'){
            alert('This is only a little preview. It is not connected with a database. You cannot create an account or log in. For more information, go to my Github page: https://github.com/Daphne-Bohm/quizzie.')
            localStorage.setItem('alerted', 'yes');
        }

});