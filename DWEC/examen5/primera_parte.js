/* Define la función suma(n,m), que me devuelva la suma de esos dos números. 3p

Defínela como función anónima y la asignas a la variable f1 y a la variable f2. ¿Qué valor da f1(3,4)? ¿Y f2(8,7)? 7p

Crea una función calculadora(param1, param2, operación) donde operación será la función para operar los dos parámetros. Podrá ser una de estas tres funciones: suma, resta, multi (sobre dos parámetros). 15 p

Usa funciones flecha en el ejemplo de la calculadora de la sesión anterior. 10p */

//Ej1 funcion normal
function suma(n, m) {
    return n + m;
};
suma(5, 6);

//Ej2 funcion anonima
var suma = function (n, m) {
    return function () {
        console.log(n + m)
    };
};

var f1 = suma(3, 4);
f1()
var f2 = suma(8, 7);
f2()

////modo 2/
function suma(n, m) {
    return function () {
        console.log(n + m)
    }
};
suma(5, 6)();

//Ej3 funcion calculadora

function calculadora(operando, n, m) {
    function suma(n, m) {
        return n + m;
    };

    function resta(n, m) {
        return n - m;
    };

    function multi(n, m) {
        return n * m;
    };

    function divi(n, m) {
        return n / m;
    };
    switch (operando) {
        case "+":
            {
                return suma(n, m)
            };
        case "-":
            {
                return resta(n, m)
            };
        case "*":
            {
                return multi(n, m)
            };
        case "/":
            {
                return divi(n, m)
            };
    }
}
console.log("suma:" + calculadora("+", 4, 5))
console.log("resta:" + calculadora("-", 4, 5))
console.log("multiplicación:" + calculadora("*", 4, 5))
console.log("división:" + calculadora("/", 4, 5))


//Ej 4 arrow function

let flcalculadora = (operando, n, m) => {
    let suma = (n, m) => {
        return n + m;
    };

    let resta = (n, m) => {
        return n - m;
    };

    let multi = (n, m) => {
        return n * m;
    };

    let divi = (n, m) => {
        return n / m;
    };
    switch (operando) {
        case "+":
            {
                return suma(n, m)
            };
        case "-":
            {
                return resta(n, m)
            };
        case "*":
            {
                return multi(n, m)
            };
        case "/":
            {
                return divi(n, m)
            };
    }
}
console.log("suma:" + flcalculadora("+", 4, 5))
console.log("resta:" + flcalculadora("-", 4, 5))
console.log("multiplicación:" + flcalculadora("*", 4, 5))
console.log("división:" + flcalculadora("/", 4, 5))
