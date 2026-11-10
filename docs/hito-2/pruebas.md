# Anexo B: Casos de prueba

| N.º | Caso de prueba | Pasos | Resultado esperado / obtenido | Estado |
| :--- | :--- | :--- | :--- | :--- |
| 1 | Filtrar por tipo de espacio | Seleccionar "Oficina Privada" y buscar. | Muestra solo las oficinas / Obtención correcta. | Aprobado |
| 2 | Búsqueda por término | Escribir "Centro" en el buscador. | Muestra espacios cuya ubicación contiene "Centro" / Obtención correcta. | Aprobado |
| 3 | Registrar con fecha pasada | Poner fecha de ayer en reserva. | Muestra error de validación rojo / Validación exitosa. | Aprobado |
| 4 | Registrar con hora fin menor a inicio | Inicio 15:00, Fin 10:00. | Muestra error de validación rojo / Validación exitosa. | Aprobado |
| 5 | Reserva exitosa completa | Poner fecha futura y horas lógicas. | Guarda en BD y muestra banner verde de éxito / Registro exitoso. | Aprobado |