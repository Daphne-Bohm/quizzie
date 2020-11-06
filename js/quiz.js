document.addEventListener('DOMContentLoaded', () => {
    
    console.log('quiz.php is loaded');


/*******************************SELECTORS**************************************/

        const notCorrect = document.getElementById('not-correct');
        const correct = document.getElementById('correct');
    
        const img = document.getElementById('question-image');
        const question = document.getElementById('question-here');
        const containerQuestion = document.getElementById('container-question');
        const containerAnswers = document.getElementById('container-answers');
        
        const stopBtn = document.getElementById('stop-btn');
        const categories = document.getElementById('categories');

        const greeting = document.getElementById('greeting');


/*******************************FUNCTIONS**************************************/
    
//WHEN WEBSITE IS OPEN

    // 1. GET CATEGORY FROM LOCAL STORAGE
    function getCategoryFromLS(){
        let category = localStorage.getItem('chosenCategory');
        let categoryInNum;
       
        if(category === 'general'){
            categoryInNum = 9;
        }else if(category === 'music'){
            categoryInNum = 12;
        }else if(category === 'math'){
            categoryInNum = 19;
        }else if(category === 'history'){
            categoryInNum = 23;
        }else if(category === 'animals'){
            categoryInNum = 27;
        }

        fetchQuestion(category, categoryInNum);  
    }

    getCategoryFromLS();

    // 2. FETCH THE QUESTION
    async function fetchQuestion(category, num){
        try{
            const url = `https://opentdb.com/api.php?amount=1&category=${num}`;
            const response = await fetch(url);
            const data = await response.json();
            displayQuestion(num, category, data);

        } catch(error) {
            console.log('There is a problem with fetching the data from Trivia DB.');
        }
    }

    // 3. DISPLAY THE QUESTION
    function displayQuestion(num, category, data){

        let color, listEl;
        if(num === 9) color = '0080E2';
        if(num === 12) color = 'E80013'; 
        if(num === 19) color = 'FF7B00';
        if(num === 23) color = 'FF38CA';
        if(num === 27) color = '0CBA00';        
       
        img.setAttribute('src', `img/${category}.png`);
        
        containerQuestion.style.background = `#${color}`;
        
        question.innerHTML = data.results[0].question;
        
        let possibleAnswers = [data.results[0].incorrect_answers, data.results[0].correct_answer];
        let flattenAnswers = possibleAnswers.flat();
        
        flattenAnswers.sort(() => Math.random() - 0.5);
        
        flattenAnswers.forEach(ans => {
            listEl = document.createElement('li');
            listEl.innerHTML= ans;
            containerAnswers.appendChild(listEl);
        });

        checkIfCorrect(data.results[0].correct_answer);
    }

    // 4. CHECK IF CORRECT
    function checkIfCorrect(correctAnswer){
        let chosenAnswer;
        let ans = 0; 
        
        containerAnswers.addEventListener('click', (e) => {
           
            chosenAnswer = e.target.innerText;

            if(chosenAnswer === correctAnswer){
                correct.innerHTML = `'${chosenAnswer}' is correct.`;
                correct.classList.add('show');
                ans+=1;
                scoresRoundCorrect(ans);
                setTimeout(() => {
                    location.reload();
                }, 2000);
                

            }else if(chosenAnswer !== correctAnswer){
                notCorrect.innerHTML = `'${chosenAnswer}' is not correct.`;
                notCorrect.classList.add('show');
                ans+=1;
                scoresRoundWrong(ans);
                setTimeout(() => {
                    location.reload();
                }, 2000);
            }
        })
    }

    // 4.A. HOW MANY CORRECT
    function scoresRoundCorrect(correct){
        let num;
        if(localStorage.getItem('correct') === null){
            localStorage.setItem('correct', JSON.stringify(correct));
        }else if(localStorage.getItem('correct') !== null){
            num = parseInt(localStorage.getItem('correct'));
            num+= correct;
            localStorage.setItem('correct', JSON.stringify(num));
        }
    }

    // 4.B. HOW MANY WRONG
    function scoresRoundWrong(wrong){
        let num;
        if(localStorage.getItem('wrong') === null){
            localStorage.setItem('wrong', JSON.stringify(wrong));
        }else if(localStorage.getItem('wrong') !== null){
            num = parseInt(localStorage.getItem('wrong'));
            num+= wrong;
            localStorage.setItem('wrong', JSON.stringify(num));
        }
    }


//WHEN USER STOPS THE QUIZ BY PRESSING THE STOP BUTTON

    // 1. UPDATE SCORES
    function keepingTrackScores(){
        let ls, totals, totalScoreCorrect, totalScoreWrong, category, objToArr, sum;

        // GET INFO FROM LS
        category = localStorage.getItem('chosenCategory');

        if(localStorage.getItem('correct') === null){
            totalScoreCorrect = 0;
        }else if(localStorage.getItem('correct') !== null){
            totalScoreCorrect = parseInt(localStorage.getItem('correct'));
        }

        if(localStorage.getItem('wrong') === null){
            totalScoreWrong = 0;
        }else if(localStorage.getItem('wrong') !== null){
            totalScoreWrong = parseInt(localStorage.getItem('wrong'));
        }
        
        // GET THE SCORE FROM ROUND
        sum = totalScoreCorrect - totalScoreWrong;

        // CHECK IF FIRST TIME PLAY?
        if(localStorage.getItem('scores') === null){ // no scores

            totals = {
                general: 0,
                music: 0,
                math: 0,
                history: 0,
                animals: 0
            };

            objToArr = Object.entries(totals);

            objToArr.forEach(item => {
                if(item.includes(category)){
                    item[1] = sum;
                }
            })

            localStorage.setItem('scores', JSON.stringify(objToArr));

        }else if(localStorage.getItem('scores') !== null){// already some scores

            ls = JSON.parse(localStorage.getItem('scores'));

            objToArr = Object.entries(ls);

            objToArr.forEach(item => {
                if(item.includes(category)){
                    item[1] += sum;
                }
            })

            localStorage.setItem('scores', JSON.stringify(objToArr));

        }

    }

    // 2. SEND SCORES TO DATABASE THROUGH URL
    function lsToDB(){
        let ls, objToArr, general, music, math, history, animals;

        if(localStorage.getItem('scores') !== null){
            
            ls = JSON.parse(localStorage.getItem('scores'));
            objToArr = Object.entries(ls);

            objToArr.forEach( el => {
                el.forEach( cat => {
                    if(cat.includes('general')) general = cat[1];
                    if(cat.includes('music')) music = cat[1];
                    if(cat.includes('math')) math = cat[1];
                    if(cat.includes('history')) history = cat[1];
                    if(cat.includes('animals')) animals = cat[1];
                })
            })

            location.href = `scores.php?general=${general}&music=${music}&math=${math}&history=${history}&animals=${animals}`;
            
            if(greeting){
                window.localStorage.removeItem('scores');
            }

        }
    }

    
    /*******************************EVENTS**************************************/
    
    // choose-category.php -> quiz.php
    if(categories){
        categories.addEventListener('click', (e) => {
            let getCategory = e.target.getAttribute('id');
            localStorage.setItem('chosenCategory', getCategory);
            location.href = 'quiz.php';
        })
    }

    // quiz.php -> scores.php
    if(stopBtn){
        stopBtn.addEventListener('click', () => {
            keepingTrackScores();
            lsToDB();
        })
    }

});
