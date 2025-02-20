<!DOCTYPE html>
<html>
<head>
    <title>Nuevo Mensaje de Contacto</title>
</head>
<body>
    <h2>Nuevo Mensaje de Contacto</h2>
    <p><strong>Nombre:</strong> {{ $contact['fullname'] }}</p>
    <p><strong>Email:</strong> {{ $contact['email'] }}</p>
    <p><strong>Asunto:</strong> {{ $contact['subject'] }}</p>
    <p><strong>Mensaje:</strong></p>
    <p>{{ $contact['message'] }}</p>
</body>
</html>
