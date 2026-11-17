# Anexo B: Casos de prueba (Hito 3)

| N.º | Caso de prueba | Pasos | Resultado esperado / obtenido | Estado |
| :---: | :--- | :--- | :--- | :---: |
| 1 | Filtrar espacios por texto | Escribir "Oficina" en el buscador y presionar Filtrar. | Muestra únicamente los espacios que coinciden con el término. | Aprobado |
| 2 | Filtrar espacios por tipo | Seleccionar "Escritorio Compartido" en el selector y filtrar. | Filtra y despliega los puestos correspondientes de ese tipo. | Aprobado |
| 3 | Validación de fecha pasada | Abrir el modal de reserva, seleccionar una fecha anterior a hoy y confirmar. | Muestra el mensaje de error de validación en color rojo. | Aprobado |
| 4 | Validación de campos vacíos | Intentar enviar el formulario de reserva sin rellenar hora ni fecha. | Bloquea el envío e indica los campos obligatorios faltantes. | Aprobado |
| 5 | Registro de reserva exitosa | Seleccionar un espacio, fecha válida y horario correcto, luego confirmar. | Muestra la alerta verde de éxito y procesa la reserva. | Aprobado |
| 6 | Persistencia de datos en SQLite | Consultar la base de datos tras un registro exitoso. | El registro de la reserva aparece correctamente almacenado en la tabla. | Aprobado |
| 7 | Protección de rutas (Auth) | Intentar acceder a `/cliente/dashboard` sin iniciar sesión. | Redirige automáticamente al formulario de autenticación (Login). | Aprobado |
| 8 | Carga de recursos dinámicos | Ejecutar `npm run dev` y `php artisan serve` simultáneamente. | Carga correctamente los estilos de Tailwind y los componentes de Alpine.js. | Aprobado |