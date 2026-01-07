// Referencia al contenedor del menú lateral
const sidebar = document.getElementById('sidebar');

/* 
    NUEVO MENÚ PARA "MI CANASTA FAMILIAR"
    Mantiene la misma estructura y funcionamiento que tu dashboard actual.
*/
const menuStructure = {
    "Inicio": [],

    "Categorías": [
        "Alimentos Frescos",
        "Lácteos y Huevos",
        "Despensa",
        "Bebidas",
        "Hogar",
        "Cuidado Personal",
        "Bebés y Niños",
        "Mascotas"
    ],

    "Mi Lista / Carrito": [
        "Productos Añadidos",
        "Estimado del Total",
        "Finalizar Compra"
    ],

    "Ofertas y Promociones": [
        "Descuentos por Temporada",
        "Combos 2x1",
        "Cupones"
    ],

    "Historial y Pedidos": [
        "Pedidos Anteriores",
        "Mi Canasta Recurrente",
        "Seguimiento de Pedido"
    ],

    "Recetas y Tips": [
        "Ideas de Comidas",
        "Consejos para Ahorrar",
        "Conservación de Alimentos"
    ],

    "Mi Cuenta": [
        "Datos Personales",
        "Direcciones de Envío",
        "Métodos de Pago",
        "Notificaciones"
    ]
};

// GENERAR EL MENÚ EN EL SIDEBAR
Object.keys(menuStructure).forEach(section => {

    const menuItem = document.createElement('div');
    menuItem.className = 'menu-item';
    menuItem.innerText = section;
    menuItem.onclick = toggleMenu;

    const subMenu = document.createElement('div');
    subMenu.className = 'sub-menu';

    // Agregar subopciones si existen
    menuStructure[section].forEach(option => {
        subMenu.innerHTML += `
            <a href="#" onclick="showContentFromSection('${option}')">${option}</a>
        `;
    });

    menuItem.appendChild(subMenu);
    sidebar.appendChild(menuItem);
});

// FUNCIÓN DEL MENÚ (ABRIR/CERRAR)
function toggleMenu(event) {
    const allSubMenus = document.querySelectorAll('.sub-menu');
    allSubMenus.forEach(m => m.style.display = 'none');

    const current = event.currentTarget.querySelector('.sub-menu');
    if (current && current.childElementCount > 0) {
        current.style.display = 'block';
    }
}

// FUNCION PARA CARGAR CONTENIDO (puedes ajustar rutas reales después)
function showContentFromSection(title) {
    document.getElementById('main-content').innerHTML = `
        <h1>${title}</h1>
        <p>Contenido pendiente de implementar...</p>
    `;
}

// FUNCIÓN DE CIERRE DE SESIÓN
function logout() {
    alert("Cerrando sesión...");
}