// Define la función para actualizar los workouts basándose en el número de días especificado.
// Si amountOfDays no se proporciona, se intentará obtener el valor del elemento con ID 'days'.
function updateWorkouts(amountOfDays = null) {
    let days = amountOfDays || document.getElementById("days").value;
    const container = document.getElementById("workoutsContainer");
    container.innerHTML = "";

    if (days <= 0) days = 1;
    else if (days > 7) days = 7;

    for (let i = 1; i <= days; i++) {
        const workoutDiv = document.createElement("div");
        workoutDiv.setAttribute("id", `day-${i}-exercises`);
        workoutDiv.classList.add("workout-day");

        const dayHeader = document.createElement("h3");
        dayHeader.textContent = `Día ${i}`;
        dayHeader.classList.add("font-bold", "text-lg", "mt-4");
        workoutDiv.appendChild(dayHeader);

        // Mueve la creación y añadidura del botón "Añadir otro ejercicio" aquí, justo después del encabezado
        const addButton = document.createElement("button");
        addButton.textContent = "Añadir otro ejercicio";
        addButton.type = "button";
        addButton.classList.add("add-exercise-button", "mt-2", "px-4", "py-2", "bg-gray-100", "text-primary", "rounded", "border", "border-gray-600");
        addButton.onclick = () => addExerciseSelector(workoutDiv, i);
        workoutDiv.appendChild(addButton);

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

    exercises.forEach((exercise) => {
        const isSelected = oldWorkouts[day] && oldWorkouts[day].includes(exercise.id.toString());
        exercisesOptions += `<option value="${exercise.id}" ${isSelected ? 'selected' : ''}>${exercise.name}</option>`;
    });

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

    adjustRemoveButtonsVisibility(container);
}



function adjustRemoveButtonsVisibility(container) {
    const selectors = container.querySelectorAll('.exercise-selector');
    selectors.forEach(selector => {
        // Elimina cualquier botón existente para resetear el estado.
        let removeButton = selector.querySelector('.remove-exercise-button');
        if (removeButton) {
            removeButton.remove();
        }

        // Si hay más de un selector, agrega el botón de quitar.
        if (selectors.length > 1) {
            removeButton = document.createElement("button");
            removeButton.textContent = "Eliminar ejercicio";
            removeButton.type = "button";
            removeButton.classList.add("remove-exercise-button","px-2","py-2","text-red-600");
            removeButton.onclick = () => {
                selector.remove(); // Elimina el selector.
                adjustRemoveButtonsVisibility(container); // Ajusta la visibilidad de nuevo tras eliminar.
            };
            selector.appendChild(removeButton);
        }
    });
}

// Evento que se dispara cuando el contenido de la página ha cargado.
window.addEventListener("DOMContentLoaded", () => {
    // Determina el número de días basándose en los datos antiguos si están disponibles, o en el valor actual del input.
    const daysInput = document.getElementById("days");
    const numberOfDays = oldWorkouts.length > 0 ? oldWorkouts.length : daysInput.value;

    // Actualiza el valor del input para reflejar el número correcto de días basado en los datos antiguos.
    daysInput.value = numberOfDays;

    // Llama a updateWorkouts para crear la interfaz basada en el número correcto de días.
    updateWorkouts(numberOfDays);
});
