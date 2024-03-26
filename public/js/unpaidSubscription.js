// Al crear si no tiene la suscripción activa muestra un mensaje de error o si la tiene activa redirige al formulario
function crearRutina(tieneSuscripcion, urlNewRoutine) {
    if (tieneSuscripcion) {
        // Redirigir al usuario a la página de creación de rutinas
        window.location.href = urlNewRoutine;
    } else {
        // Mostrar mensaje de error
        mostrarNotificacion(
            "Necesitas tener una suscripción pagada activa para crear más rutinas."
        );
    }
}
// Al editar si no tiene la suscripción activa muestra un mensaje de error o si la tiene activa redirige al formulario
function editarRutina(tieneSuscripcion, urlEditRoutine) {
    if (tieneSuscripcion) {
        // Redirigir al usuario a la página de creación de rutinas
        window.location.href = urlEditRoutine;
    } else {
        // Mostrar mensaje de error
        mostrarNotificacion(
            "Necesitas tener una suscripción pagada activa para editar rutinas."
        );
    }
}

// Muestra un mensaje si intenta eliminar una rutina y no tiene una subscripción activa
function eliminarRutina() {
    // Mostrar mensaje de error
    mostrarNotificacion(
        "Necesitas tener una suscripción pagada activa para eliminar rutinas."
    );
}

// Función para mostrar la notificación de manera dinámica
function mostrarNotificacion(mensaje, tipo = "error") {
    const notificationContainer = document.getElementById(
        "dynamicNotification"
    );
    const notificationText = document.getElementById("dynamicNotificationText");
    const notificationSvg = notificationContainer.querySelector("svg");

    // Define los colores y el path del SVG según el tipo de mensaje
    const config = {
        error: {
            color: "bg-red-100",
            fill: "maroon",
            textClass: "text-red-700",
            path: "M12,0A12,12,0,1,0,24,12,12.013,12.013,0,0,0,12,0Zm0,22A10,10,0,1,1,22,12,10.011,10.011,0,0,1,12,22Z M12,5a1,1,0,0,0-1,1v8a1,1,0,0,0,2,0V6A1,1,0,0,0,12,5Z M11,17h2v2h-2Z",
        },
        success: {
            color: "bg-emerald-100",
            fill: "green",
            textClass: "text-emerald-700",
            path: "M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-111 111-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L369 209z",
        },
    };

    // Aplica la configuración según el tipo
    notificationContainer.className = `flex w-full flex-row flex-wrap items-center py-4 px-4 md:px-5 my-4 mx-2 md:mx-5 gap-4 ${config[tipo].color}`;
    notificationSvg.className = `w-10 h-20`;
    notificationSvg.style = `fill: ${config[tipo].fill};`;
    notificationSvg.innerHTML = `<path d="${config[tipo].path}" />`;
    notificationText.className = `text-lg ${config[tipo].textClass}`;
    notificationText.textContent = mensaje;

    // Muestra el contenedor de la notificación
    notificationContainer.classList.remove("hidden");
    // Oculta la notificación después de 5 segundos (5000 milisegundos)
    setTimeout(function () {
        notificationContainer.classList.add("hidden");
    }, 5000);
}
