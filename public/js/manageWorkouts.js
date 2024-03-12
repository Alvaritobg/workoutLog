function updateWorkouts() {
    let days = document.getElementById("days").value;
    const container = document.getElementById("workoutsContainer");

    // Limpiar el contenedor actual
    container.innerHTML = "";

    // Acotamos el número de días (min 1 max 7)
    if (days <= 0) {
        days = 1;
    } else if (days > 7) {
        days = 7;
    }

    for (let i = 1; i <= days; i++) {
        const workoutDiv = document.createElement("div");
        workoutDiv.setAttribute("id", `day-${i}-exercises`);
        workoutDiv.classList.add("workout-day");

        // Encabezado para cada día
        const dayHeader = document.createElement("h3");
        dayHeader.textContent = `Día ${i}`;
        dayHeader.classList.add("font-bold", "text-lg", "mt-4"); // Puedes ajustar las clases según tu diseño

        workoutDiv.appendChild(dayHeader);

        // Añade el primer select de ejercicios
        addExerciseSelector(workoutDiv, i);

        // Botón para añadir más ejercicios
        const addButton = document.createElement("button");
        addButton.textContent = "Añadir otro ejercicio";
        addButton.type = "button"; // Importante para evitar que el botón envíe el formulario
        addButton.onclick = () => addExerciseSelector(workoutDiv, i);
        addButton.classList.add(
            "mt-2",
            "px-4",
            "py-2",
            "bg-gray-100",
            "text-primary",
            "rounded",
            "border",
            "border-gray-600"
        );

        workoutDiv.appendChild(addButton);
        container.appendChild(workoutDiv);
    }
}

function addExerciseSelector(container, day) {
    const selectorDiv = document.createElement("div");
    let exercisesOptions = "";
    exercises.forEach((exercise, i) => {
        exercisesOptions += `<option value="${exercise.id}" name="${exercise.name}">${exercise.name}</option>`;
    });


    selectorDiv.innerHTML = `
    <div class="mt-4 flex items-center">
        <select name="workouts[${day}][]"
        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full mr-2">
            ${exercisesOptions}
        </select>
    </div>
    `;

    // Inserta el selector antes del botón de añadir
    const addButton = container.querySelector("button");
    container.insertBefore(selectorDiv, addButton);

}


