import './bootstrap';

import Alpine from 'alpinejs';
import Swal from 'sweetalert2';

window.saludar = function(name, descripcion) {
    Swal.fire({
        title: name,
        text: descripcion,
        icon: 'info',
    });
}
window.Alpine = Alpine;

Alpine.start();
