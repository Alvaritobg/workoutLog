import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Formulario de registro
document.addEventListener('DOMContentLoaded', () => {
    const weightDiv = document.getElementById('cont_weight');
    if (weightDiv) {
        const isTrainer = document.getElementById('trainer');
        isTrainer.addEventListener('change', () => {
            let show = isTrainer.value === 'true' ? true : false;
            if (show) {
                weightDiv.style.display = "none";
            } else {
                weightDiv.style.display = "block";
            }
        });
    }
});
