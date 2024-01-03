window.onload = function(){
    let notificari = document.getElementById('notificari');
    let setari = document.getElementById('setari');
  

    notificari.onclick = function(){
        if(document.getElementById('notificari-content').style.display == 'flex')
            document.getElementById('notificari-content').style.display = 'none';
        else document.getElementById('notificari-content').style.display = 'flex';
    }
    setari.onclick = () => {
        if(document.getElementById('setari-content').style.display == 'flex')
            document.getElementById('setari-content').style.display = 'none';
        else document.getElementById('setari-content').style.display = 'flex';
    }
}