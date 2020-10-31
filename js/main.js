document.addEventListener('DOMContentLoaded', () => {

    console.log('The website is loaded')
      
    
/**********************************************************************************/
    
    // SELECTORS
    const chooseColor = document.getElementById('chooseColor');
    const changeColor = document.getElementById('changeColor');

    // CHECK LOCAL STORAGE
    function checkLS(chosenColor){
        if(localStorage.getItem('chosenColor') !== ''){
            window.localStorage.removeItem('chosenColor');
            saveTheChosenColor(chosenColor);
            displayTheChosenColor(chosenColor);
        }else{
            saveTheChosenColor(chosenColor);
            displayTheChosenColor(chosenColor);
        }  
    }

    // SAVE THE CHOSEN COLOR OF USER
    function saveTheChosenColor(color){
        const chosenColor = localStorage.getItem('chosenColor') || '';
        if(chosenColor === ''){
            localStorage.setItem('chosenColor', color);
        }
    }
   
    // DISPLAY THE CHOSEN COLOR 
    function displayTheChosenColor(color){
        
        const overlay = document.querySelector('.overlay');
        const gamepad = document.getElementById('gamepad');
        const extraOverlay = document.getElementById('extra-overlay');

        if(localStorage.getItem('chosenColor') !== ''){
            let c = localStorage.getItem('chosenColor');
            overlay.style.backgroundColor = `var(--${c})`;
            gamepad.style.fill = `var(--${c})`;
            if(extraOverlay){
                extraOverlay.style.backgroundColor = `var(--${c})`;
            }
        }else{
            overlay.style.backgroundColor = `var(--${color})`;
            gamepad.style.fill = `var(--${color})`;
            if(extraOverlay){
                extraOverlay.style.fill = `var(--${color})`;
            }
        }
    }

    displayTheChosenColor();

    // EVENTS
    if(chooseColor){
            chooseColor.addEventListener('click', (e) => {
                if(e.target.classList[1] === 'colors'){
                    let chosenColor = e.target.getAttribute('id');
                    checkLS(chosenColor);
                }
            })
    };

    if(changeColor){
        changeColor.addEventListener('click', (e) => {
            if(e.target.classList[1] === 'colors'){
                let chosenColor = e.target.getAttribute('id');
                checkLS(chosenColor);
            }
        });
    }
    
    

});

    
    







