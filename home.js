window.onload = function(){
    let notificari = document.getElementById('notificari');
    let setari = document.getElementById('setari');
    let notifs = document.getElementById('notificari-content');
    let sets = document.getElementById('setari-content')
    let sports = document.getElementsByClassName('sport');
    let contests = document.getElementsByClassName('concurs');

    notificari.onclick = function(){
        if(notifs.classList.contains('invisible'))
            notifs.classList.remove('invisible');
        else
            notifs.classList.add('invisible');
    }
    setari.onclick = () => {
        if(sets.classList.contains('invisible'))
            sets.classList.remove('invisible');
        else
            sets.classList.add('invisible');
    }
    Array.from(sports).forEach(function(sport) {
        sport.addEventListener('click', (event) => {
            if(event.target.classList.contains('selected'))
                event.target.classList.remove('selected');
            else
                event.target.classList.add('selected');
        });
    });
    Array.from(contests).forEach(function(contest){
        contest.addEventListener('click', (event) => {
            location.href = 'concurs.php?id='+contest.getAttribute('data_id');
        });
    });
}