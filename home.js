window.onload = function(){
    let notificari = document.getElementById('notificari');
    let setari = document.getElementById('setari');
    let notifs = document.getElementById('notificari-content');
    let sets = document.getElementById('setari-content')

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
}