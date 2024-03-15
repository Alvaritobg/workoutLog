// Define la función para actualizar los workouts basándose en el número de días especificado.
// Si amountOfDays no se proporciona, se intentará obtener el valor del elemento con ID 'days'.
function updateWorkouts(amountOfDays = null) {
    // Determina el número de días basado en el argumento proporcionado o en el valor del input 'days'.
    let days = amountOfDays || document.getElementById("days").value;
    // Obtiene el contenedor donde se añadirán los workouts.
    const container = document.getElementById("workoutsContainer");
    // Limpia cualquier contenido previo en el contenedor.
    container.innerHTML = "";

    // Asegura que el número de días esté dentro de un rango válido (1 a 7).
    if (days <= 0) days = 1;
    else if (days > 7) days = 7;

    // Crea y añade los elementos necesarios para cada día en el rango especificado.
    for (let i = 1; i <= days; i++) {
        // Crea un nuevo div para cada día de workout.
        const workoutDiv = document.createElement("div");
        workoutDiv.setAttribute("id", `day-${i}-exercises`);
        workoutDiv.classList.add("workout-day");

        // Añade un encabezado para indicar el número del día.
        const dayHeader = document.createElement("h3");
        dayHeader.textContent = `Día ${i}`;
        dayHeader.classList.add("font-bold", "text-lg", "mt-4", "dia");
        workoutDiv.appendChild(dayHeader);

        // Crea y configura un botón para añadir más ejercicios a este día.
        const addButton = document.createElement("button");
        addButton.textContent = "Añadir otro ejercicio";
        addButton.type = "button";
        addButton.classList.add(
            "add-exercise-button",
            "mt-2",
            "px-4",
            "py-2",
            "bg-gray-100",
            "text-primary",
            "rounded",
            "border",
            "border-gray-600"
        );
        addButton.onclick = () => addExerciseSelector(workoutDiv, i);
        workoutDiv.appendChild(addButton);

        // Añade el div de workout al contenedor principal.
        container.appendChild(workoutDiv);

        // Añade el primer selector de ejercicios después de haber colocado el botón.
        addExerciseSelector(workoutDiv, i);
    }
}

// Función para añadir un selector de ejercicios a un contenedor específico.
function addExerciseSelector(container, day) {
    const selectorDiv = document.createElement("div");
    selectorDiv.classList.add("exercise-selector");
    let exercisesOptions = "";

    // Itera sobre una lista de ejercicios predefinidos para generar las opciones del selector.
    exercises.forEach((exercise) => {
        const isSelected =
            oldWorkouts[day] &&
            oldWorkouts[day].includes(exercise.id.toString());
        exercisesOptions += `<option value="${exercise.id}" ${
            isSelected ? "selected" : ""
        }>${exercise.name}</option>`;
    });

    // Configura el HTML interno del div con el selector y las opciones generadas.
    selectorDiv.innerHTML = `
        <div class="mt-4 flex items-center">
            <select name="workouts[${day}][]" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full mr-2">
                ${exercisesOptions}
            </select>
        </div>
    `;

    // Inserta el nuevo selector de ejercicios justo antes del botón "Añadir otro ejercicio".
    const addButton = container.querySelector(".add-exercise-button");
    container.insertBefore(selectorDiv, addButton);

    // Ajusta la visibilidad de los botones de eliminar.
    adjustRemoveButtonsVisibility(container);
}

function adjustRemoveButtonsVisibility(container) {
    const selectors = container.querySelectorAll(".exercise-selector");
    selectors.forEach((selector) => {
        let removeButton = selector.querySelector(".remove-exercise-button");
        if (removeButton) {
            removeButton.remove();
        }

        // Si hay más de un selector, agrega el botón de quitar.
        if (selectors.length > 1) {
            removeButton = document.createElement("button");
            removeButton.textContent = "Eliminar ejercicio";
            removeButton.type = "button";
            removeButton.classList.add(
                "remove-exercise-button",
                "px-2",
                "py-2",
                "text-red-600"
            );
            removeButton.onclick = () => {
                // Elimina el selector y ajusta la visibilidad de nuevo tras eliminar.
                selector.remove();
                adjustRemoveButtonsVisibility(container);
            };
            selector.appendChild(removeButton);
        }
    });
}
// Valida que no se ponga dos veces el mismo ejercicio en el mismo entrenamiento/día
// Evento que se dispara cuando el contenido de la página ha cargado.
document.addEventListener("DOMContentLoaded", () => {
    const formRutina = document.getElementById("formRutina");
    const errFormContainer = document.getElementById("errFormContainer");
    const errorFormText = document.getElementById("errorForm");

    // Oculta el contenedor de errores al cargar la página
    errFormContainer.style.display = "none";

    formRutina.addEventListener("submit", (event) => {
        event.preventDefault(); // Previene el envío inicial del formulario

        const allSelects = formRutina.querySelectorAll(
            'select[name^="workouts["]'
        );
        let isValid = true;
        let repeatedExercises = {};
        let errorMessages = [];

        allSelects.forEach((select) => {
            const day = select.name.match(/\[(\d+)\]/)[1]; // Extrae el número del día
            const exerciseId = select.value;

            if (!repeatedExercises[day]) {
                repeatedExercises[day] = [];
            }

            if (repeatedExercises[day].includes(exerciseId)) {
                isValid = false; // Marca el formulario como inválido si hay duplicados
                errorMessages.push(
                    `-Hay ejercicios repetidos en el día ${day}.`
                );
            } else {
                repeatedExercises[day].push(exerciseId);
            }
        });

        if (!isValid) {
            // Muestra el contenedor de errores y actualiza el mensaje
            errFormContainer.style.display = "flex";
            errorFormText.innerHTML = errorMessages.join("<br>");

            // Mueve el foco al contenedor de errores
            errFormContainer.scrollIntoView({
                behavior: "smooth",
                block: "center",
            });

            // Oculta el contenedor de errores después de 5 segundos
            setTimeout(() => {
                errFormContainer.style.display = "none";
            }, 5000);
        } else {
            formRutina.submit();
        }
    });
});
