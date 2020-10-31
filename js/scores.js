document.addEventListener('DOMContentLoaded', () => {

    console.log('scores.php is loaded');
    
    const img = document.getElementById('img-question');
    const resCorrect = document.getElementById('result-correct');
    const resWrong = document.getElementById('result-wrong');
    const wrongCorrectContainer = document.getElementById('wrong-correct-answer');

// SHOW SCORES HOW MANY CORRECT AND NOT
    function showHowManyCorrectAndWrong(){
        let category, correct, wrong, categoryNum, color;

        if(localStorage.getItem('chosenCategory') !== null){
            category = localStorage.getItem('chosenCategory');
            if(category === 'general'){
                categoryNum = 9;
                color = '0080E2';
            } 
            if(category === 'music'){
                categoryNum = 12;
                color = 'E80013';
            } 
            if(category === 'math'){
                categoryNum = 19;
                color = 'FF7B00'; 
            }
            if(category === 'history'){
                categoryNum = 23;
                color = 'FF38CA';
            } 
            if(category === 'animals'){
                categoryNum = 27;
                color = '0CBA00';
            } 

        }else{
            console.log('No, category chosen.');
        }

        if(localStorage.getItem('correct') === null){
            resCorrect.innerHTML = 0;
            
        }else if(localStorage.getItem('correct') !== null){
            correct = localStorage.getItem('correct');
            resCorrect.innerHTML = correct;
        }

        if(localStorage.getItem('wrong') === null){
            resWrong.innerHTML = 0;

        }else if(localStorage.getItem('wrong') !== null){
            wrong = localStorage.getItem('wrong');
            resWrong.innerHTML = wrong;
        }

        img.setAttribute('src', `img/${category}.png`);
        wrongCorrectContainer.style.background = `#${color}`;

        window.localStorage.removeItem('correct');
        window.localStorage.removeItem('wrong');
    } 

    showHowManyCorrectAndWrong();

// GET THE INFO FROM THE DB TO UPDATE THE LS

    function getInfoFromURL(){

        const info = location.href; //string
        const splittedURL = info.split('&');
        
        const splitOnceMore = splittedURL[0].split('?');
        const makeString = splitOnceMore[1].toString();

        const generalScoreDB = parseInt(makeString.slice(11, (makeString.length - 3)));
        const musicScoreDB = parseInt(splittedURL[1].slice(9, (splittedURL[1].length - 3)));
        const mathScoreDB = parseInt(splittedURL[2].slice(8, (splittedURL[2].length - 3)));
        const historyScoreDB = parseInt(splittedURL[3].slice(11, (splittedURL[3].length - 3)));
        const animalsScoreDB = parseInt(splittedURL[4].slice(11, (splittedURL[4].length - 3)));  

        saveToLS(generalScoreDB, musicScoreDB, mathScoreDB, historyScoreDB, animalsScoreDB);

    }

    getInfoFromURL();

    function saveToLS(genDB, musDB, matDB, hisDB, animDB){

        let newLS;

        newLS = {
            general: genDB,
            music: musDB,
            math: matDB,
            history: hisDB,
            animals: animDB
        };
        
        localStorage.setItem('scores', JSON.stringify(newLS));

    }


});

    
    







