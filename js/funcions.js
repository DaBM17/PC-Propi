function menuUsuari(){
    const usuario = document.getElementById('user_pic');
    const menuDesplegable = document.getElementById('menu-desplegable');

    if (menuDesplegable.style.display === 'block') {
        menuDesplegable.style.display = 'none';
    } else {
        menuDesplegable.style.display = 'block';
    }

    document.addEventListener('click', (event) => {
        if (event.target !== usuario && event.target !== menuDesplegable) {
            menuDesplegable.style.display = 'none';
        }
    });
}

function updateCabas(numProd)
{
    let missatge = document.getElementById("cabas");
    missatge.innerHTML = "<p id='cabas'>Productes al cabàs: " + numProd + 1 + "</p>";
}
