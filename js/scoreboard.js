document.addEventListener('DOMContentLoaded', () => {
    
    console.log('scoreboard.php is loaded')

    const general = document.getElementById('general-score');
    const music = document.getElementById('music-score');
    const math = document.getElementById('math-score');
    const history = document.getElementById('history-score');
    const animals = document.getElementById('animals-score');

    function displayScoresInScoreBoard(){
        let ls, objToArr, genScore, musScore, matScore, historyScore, animalsScore;

        if(localStorage.getItem('scores') !== null){
            ls = JSON.parse(localStorage.getItem('scores'));

            objToArr = Object.entries(ls);

            objToArr.forEach(score => {
                if(score.includes('general')) genScore = score[1];
                if(score.includes('music')) musScore = score[1];
                if(score.includes('math')) matScore = score[1];
                if(score.includes('history')) historyScore = score[1];
                if(score.includes('animals')) animalsScore = score[1];
            });

            general.innerText = genScore;
            music.innerText = musScore;
            math.innerText = matScore;
            history.innerText = historyScore;
            animals.innerText = animalsScore;

        }else if(localStorage.getItem('scores') === null){

            general.innerText = 0;
            music.innerText = 0;
            math.innerText = 0;
            history.innerText = 0;
            animals.innerText = 0;
        
        }

    }

    displayScoresInScoreBoard();

});