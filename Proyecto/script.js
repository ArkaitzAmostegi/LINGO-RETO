
    //Endpoint para la palabra secreta
    'use strict';

    const ENDPOINT = "http://185.60.43.155:3000/api/word/1";
    let palabraSecreta = "";

    // 1) Función asíncrona: usa await con fetch y con resp.json() (Sin control de errores)
    async function leerPalabra() {
        const resp = await fetch(ENDPOINT);      // espera la respuesta HTTP
        const data = await resp.json();          // lee y parsea el cuerpo a JSON
        palabraSecreta = (data.word).toUpperCase();
        console.log(palabraSecreta);
    }

    let tiempoLinea; //En segundos
    let tiempoPartida; //En segundos
        //Función TEMPORIZADOR REGRESIVO PARTIDA
    function actualizarTiempoPartida() {
        let unidades = tiempoPartida % 10;
        let decenas = Math.floor(tiempoPartida / 10) % 10;
        let centenas = Math.floor(tiempoPartida / 100) % 10;

        const imgCen = document.getElementById("partida-centenas");
        const imgDec = document.getElementById("partida-decenas");
        const imgUni = document.getElementById("partida-unidades");

        imgCen.src = `imagenes/Numeros/${centenas}.png`;
        imgDec.src = `imagenes/Numeros/${decenas}.png`;
        imgUni.src = `imagenes/Numeros/${unidades}.png`;
    }
    //Función TEMPORIZADOR REGRESIVO LINEA
    function actualizarTiempoLinea() {
        let unidades = tiempoLinea % 10;
        let decenas = Math.floor(tiempoLinea / 10);

        const imgDec = document.getElementById("linea-decenas");
        const imgUni = document.getElementById("linea-unidades");

        imgDec.src = `imagenes/Numeros/${decenas}.png`;
        imgUni.src = `imagenes/Numeros/${unidades}.png`;
    }
    let intervaloPartida = null;
    let intervaloLinea = null;

    //Actualiza el tiempo de la partida, si llega a cero o todo el tablero tiene letras, acaba la partida
    function contaTiempoPartida() {
        actualizarTiempoPartida();
        intervaloPartida = setInterval(() => {
            tiempoPartida--;
            actualizarTiempoPartida();

            if (tiempoPartida <= 0  || tableroLleno()) {
                clearInterval(intervaloPartida);          
                finPartida();
                window.location.href= "noAcertado.html"
            }
        }, 1000);
    }
    //Nos vas a actualizar el tiempo por línea, si llega a cero acaba la aprtida y cambia de págian
    function contaTiempoLinea() {
        actualizarTiempoLinea();
        intervaloLinea = setInterval(() => {
            tiempoLinea--;
            actualizarTiempoLinea();

            if (tiempoLinea <= 0){
                clearInterval(intervaloLinea);
                finPartida();
                window.location.href = "noAcertado.html";
            }
        }, 1000);
    }

    //Función para detener el tiempo y ponerlo a los valores iniciales
    function finPartida() {
        clearInterval(intervaloPartida);
        clearInterval(intervaloLinea);
        tiempoPartida = 180;
        tiempoLinea = 60;
        actualizarTiempoPartida();
        actualizarTiempoLinea();
        
        // Deshabilitar clics en el teclado
        document.querySelectorAll('#container-teclado img').forEach(img => img.onclick = null);
    }

    //Para comprobar si quedan casillas vacias, o está todo el tablero escrito por el usuario, y se termina la partida
    function tableroLleno() {
        const celdas = document.querySelectorAll("#container-tabla img");
        let lleno = true; // asumimos que está lleno

        for (let i = 0; i < celdas.length; i++) {
            if (celdas[i].src.includes("29.png")) {
                lleno = false; // encontramos una vacía
                break;         // no hace falta seguir mirando
            }
        }

        return lleno;
    }

    //Variable para contar la cantidad de letras por línea
    let contLetras = 0;
    //Variable para contar cuantas veces ha fallado la palabra secreta. Contador de línea
    let contNoSonIguales = 0;
    //Array para identificar el teclado 
    let abecedario = ["Q","W","E","R","T","Y","U","I","O","P","A","S","D","F","G","H","J","K","L","Ñ"," ","Z","X","C","V","B","N","M"," "," "];
    //Array para formar una palabra con las letras que el usuario presione
    let letras = [];
    //Array para guardar los ID de las celdas donde se insertan las letras
    let celdaIdArray = [];
    let celdaId; 

    
    // --- BLOQUE PARA CREAR LA CUADRICULA LINGO ---
    const tabla = document.getElementById("container-tabla");
    let N = 5;
    let sHTML = "";

    // Creamos las 25 celdas como divs
    for (let i = 0; i < N; i++) {
        for (let j = 0; j < N; j++) {
            sHTML += `
            <div class="celda1 ${j}">
                <img id="${i}${j}" src="imagenes/verdes/29.png">
            </div>
            `;
        }
    }
    tabla.innerHTML = sHTML;

    // --- BLOQUE PARA CREAR EL TECLADO ---
    const teclado = document.getElementById("container-teclado");
    let fila = 3;
    let columna = 10;
    let tecl = "";

    for (let l = 0; l < fila; l++) {
        for (let n = 0; n < columna; n++) {
            tecl += `
            <div class="celda2">
                <img id="${l}${n}" src="imagenes/azules/${l}${n}.png" onclick="presionaTecla(this)">
            </div>
            `;
        }
    }
    teclado.innerHTML = tecl;


    //PARA COMENZAR EL JUEGO
    let comenzarPartida = false;
    document.querySelector(".jugar").addEventListener("click", empezarPartida)
    function empezarPartida(){
        //LLamamos a la función para que traiga una palabra secreta
        leerPalabra();
        comenzarPartida = true;
        // Si ya hay un temporizador en marcha, lo detenemos
        if (intervaloPartida) clearInterval(intervaloPartida);
        tiempoPartida = 180;
        tiempoLinea = 60;
        //Empieza a contar el tiempo de partida
        contaTiempoPartida();
    }


    //Función para que aparezca la letra presionada en el lugar correspondiente
    function presionaTecla(elemento) {
        if (comenzarPartida){
            // Obtengo el id de la tecla, y la paso a número (aunque será un string con dos cifras)
            let letra = Number(elemento.id);
            //Introduzco en el array palabra cada letra según la posición del abecedario
            letras.push(abecedario[letra]);

            //Mensajes de depuración
            console.log('ID tecla:', letra);
            console.log('SRC tecla:', elemento.src);
            console.log("Array abecedario", abecedario[letra]);
            console.log("Array letras", letras);

            //Selecciono todas las celdas (todas las imágenes de la tabla principal)
            let containerTabla = document.getElementById("container-tabla");
            let celdas = containerTabla.querySelectorAll("img");

            // Recorro las celdas de la tabla principal
            for (let celda of celdas) {
                
                // Compruebo si la celda está vacía (imagen de vacio.gif)
                if (celda.src.includes("29.png")) { 
                    
                    // Si está vacía, le asigno la imagen de la tecla pulsada
                    celda.src = elemento.src;
                    contLetras++;  //Incremento el contador de letras introducidas  
                    console.log("Contador letras fila: ", contLetras);   

                    celdaIdArray.push(celda.id); //Meto el ID en el array de celdas
                    //Reinicio del tiempo de línea al escribir la primera letra
                    
                    //Si ya se han introducido 5 letras
                    if (contLetras === 5) {
                        console.log("Palabra completa");
                        let palabraGenerada = "";// Reiniciar el temporizador de línea, cada vez que empieza una nueva línea
                        if (intervaloLinea) clearInterval(intervaloLinea);
                        tiempoLinea = 60;
                        contaTiempoLinea();
                        //Recorro el array palabra, para unir las letras en un string
                        letras.forEach(elemento => {
                            palabraGenerada = palabraGenerada + elemento; 
                        });
                        contLetras = 0;  //Reinicio el contador de letras
                        console.log(palabraGenerada)
                        //delete letras; NO hace falta eliminar el array letras, creando nuevo es suficiente
                        letras = [];   //Creo uno nuevo array
                        compara(palabraSecreta, palabraGenerada); //Llamo a la función que compara las dos palabras
                    }else{
                        //Si aún no se han completado 5 letras
                        celdaId = celda.id; //Guardo el ID de la celda actual
                    }
                break; //Rompo el bucle para no seguir recorriendo las celdas
                }
            }
        }
    }

    //Función que compara los strings palabraSecreta y palabraGenerada
    function compara(palabraSecreta, palabraGenerada) {

        // Convertimos ambas palabras a mayúsculas para comparar correctamente
        palabraGenerada = palabraGenerada.toUpperCase();
        palabraSecreta = palabraSecreta.toUpperCase();
        
        let contAciertos = 0; // Reinicio del contador de aciertos

        // Pintamos las verdes con los aciertos
        for (let i = 0; i < palabraSecreta.length; i++) {
            
            // Mostramos por consola qué letras se comparan
            console.log(`Comparando: '${palabraSecreta[i]}' con '${palabraGenerada[i]}'`);

            // Buscamos el código numérico de la letra en el array abecedario
            let codigo = abecedario.indexOf(palabraGenerada[i]);

            if (codigo === -1) codigo = 0;

            if(palabraSecreta[i] === palabraGenerada[i]){
                contAciertos++;
                let codigoFormateado = codigo.toString().padStart(2, '0');
                document.getElementById(celdaIdArray[i]).src = `imagenes/verdes/${codigoFormateado}.png`;
            }
        }

        //Pintamos las naranjas o rojas(sin tocar los verdes)
        for(let i = 0; i<palabraSecreta.length;i++){
                
            // Mostramos por consola qué letras se comparan
            console.log(`Comparando: '${palabraSecreta[i]}' con '${palabraGenerada[i]}'`);

            // Buscamos el código numérico de la letra en el array abecedario
            let codigo = abecedario.indexOf(palabraGenerada[i]);
            if (codigo === -1) codigo = 0;

            // Si ya está en verde, saltamos
            let img = document.getElementById(celdaIdArray[i]);
            if (img.src.includes("verdes")) continue;

            if (palabraSecreta.includes(palabraGenerada[i])) {
                // Letra está en la palabra, pero no en esa posición
                let codigoFormateado = codigo.toString().padStart(2, '0');
                img.src = `imagenes/naranjas/${codigoFormateado}.png`;
            } else {
                // Letra no está en la palabra
                let codigoFormateado = codigo.toString().padStart(2, '0');
                img.src = `imagenes/rojas/${codigoFormateado}.png`;
            }
        }

        // Si todas las letras son iguales, has ganado
        if (contAciertos === palabraSecreta.length) {
            alert("Has acertado la palabra secreta. ¡ENHORABUENA!");
            finPartida();
            window.location.href= "acertado.html"
        } else {
            console.log("NO son iguales");
            contNoSonIguales ++;
        }
        if (contNoSonIguales === 5){
            alert("No has acertado la palabra Secreta!!!", palabraSecreta);
        }

        // Limpiamos el array de celdas para la siguiente palabra
        celdaIdArray = [];
    }
