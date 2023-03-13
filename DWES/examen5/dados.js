/* dados.js. Crear un programa que simule un juego en el que se lanzan dos dados. Ganará el número más pequeño.*/


let dados = new Promise((resolve, reject) => {
    let dado1 = 0
    let dado2 = 0
    let resultado = ""
    let tirada1 = new Promise(function (resolve, reject) {
        // the function is executed automatically when the promise is constructed
        dado1 = Math.floor(Math.random() * 6) + 1;
        // after 1 second signal that the job is done with the result "done"
        setTimeout(() => resolve(dado1), 1000);
    });
    let tirada2 = new Promise(function (resolve, reject) {
        // the function is executed automatically when the promise is constructed
        dado2 = Math.floor(Math.random() * 6) + 1;
        // after 1 second signal that the job is done with the result "done"
        setTimeout(() => resolve(dado2), 2000);
    });
    tirada1.then(
        function (result) { console.log("El resultado de la tirada 1 es " + result); },
        function (error) { /* handle an error */ }
    );
    tirada2.then(
        function (result) { console.log("El resultado de la tirada 2 es " + result); },
        function (error) { /* handle an error */ }
    );
    if (dado1 < dado2) { resultado = "victoria para jugador 1" }
    else if (dado1 == dado2) { resultado = "empate" }
    else if (dado1 > dado2) { resultado = "victoria para jugador 2" }

    setTimeout(() => resolve(resultado), 2500);
});

dados.then(
    function (result) { console.log("El resultado de la partida es " + result) },
    function (error) { /* handle an error */ }
);