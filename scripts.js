// Inicializa el selector de fecha con Flatpickr
flatpickr("#fecha_nacimiento", {
    dateFormat: "d-m-Y",  // Cambia el formato a día-mes-año
    maxDate: "today",     // Limita la fecha máxima a la fecha actual
    onChange: function(selectedDates) {
        const hoy = new Date();
        const fechaNacimiento = selectedDates[0];
        const edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
        
        // Muestra u oculta la sección para menores de 18 años
        document.getElementById("sectionEdad18").style.display = (edad < 18) ? "block" : "none";
    }
});

function validarFormulario() {
    const fechaNacimiento = new Date(document.querySelector('#fecha_nacimiento')._flatpickr.selectedDates[0]);
    const hoy = new Date();
    const edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
    
    if (edad < 18) {
        alert('Debes ser mayor de 18 años o subir autorización.');
        return false;
    }

    const habilidades = document.querySelectorAll('input[name="habilidades[]"]:checked');
    if (habilidades.length === 0) {
        alert('Debes seleccionar al menos una habilidad.');
        return false;
    }
    return true;
}

function seleccionarTodas() {
    const todos = document.querySelector('input[value="todos"]');
    const habilidades = document.querySelectorAll('input[name="habilidades[]"]');
    habilidades.forEach((checkbox) => {
        if (checkbox !== todos) checkbox.checked = todos.checked;
    });
}

function habilitarAutorizacion() {
    const menorEdad = document.querySelector('input[name="menor_edad"]').checked;
    document.getElementById('autorizacion_pdf').style.display = menorEdad ? 'block' : 'none';
}

const textarea = document.getElementById('descripcion');
const contador = document.getElementById('contador');

textarea.addEventListener('input', () => {
  const length = textarea.value.length;
  contador.textContent = `${length}/1000`; //contador de

  if (length === 1000) {
    contador.style.color = 'red';  
    contador.classList.add('temblor'); 
  } else {
    contador.style.color = 'black'; 
    contador.classList.remove('temblor');  
  }
});





