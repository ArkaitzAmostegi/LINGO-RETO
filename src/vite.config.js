import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],

    //Este server es para la conexión de los profesores en CLASE con el host 10.10.18.189
    server: {
        host: '0.0.0.0', // Escucha en todas las interfaces
        port: 5173,      // Asegura el mismo puerto
        cors: true,             // <--- permite CORS desde cualquier origen
        hmr: {
            host: '10.10.18.189', // Tu IP del host
            protocol: 'http',
        },
    },
});

//Este server he tenido que poner en CASA por el host y el hmr que no los localizaba
//aAl poner en el host localhost, va a buscar el vite, el css a ese ordenador, si pongo una ip como arriba es para cuendo el ordenador de esa ip este encendido, vaay a buscar el css a ese ordendor

//     server: {
//         host: '0.0.0.0',
//         port: 5173,
//         cors: true,
//         hmr: {
//             host: 'localhost',   // <= NO 10.10.18.189
//             protocol: 'http',
//             clientPort: 5173,    // <= importante en Docker
//         },
//         origin: 'http://localhost:5173', // ayuda a que las URLs sean absolutas correctas
//     },
// });
