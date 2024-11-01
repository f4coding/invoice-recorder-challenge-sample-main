<!DOCTYPE html>
<html>
<head>
    <title>Comprobantes Subidos</title>
</head>
<body>
    <h1>Estimado {{ $user->name }},</h1>
    <p>Hemos recibido tus comprobantes con los siguientes detalles:</p>

    <h2>Comprobantes Subidos Correctamente:</h2>
    @foreach ($successfulVouchers as $comprobante)
    <ul>
        <li>Nombre del Emisor: {{ $comprobante->issuer_name }}</li>
        <li>Tipo de Documento del Emisor: {{ $comprobante->issuer_document_type }}</li>
        <li>Número de Documento del Emisor: {{ $comprobante->issuer_document_number }}</li>
        <li>Nombre del Receptor: {{ $comprobante->receiver_name }}</li>
        <li>Tipo de Documento del Receptor: {{ $comprobante->receiver_document_type }}</li>
        <li>Número de Documento del Receptor: {{ $comprobante->receiver_document_number }}</li>
        <li>Monto Total: {{ $comprobante->total_amount }}</li>
    </ul>
    @endforeach

    <h2>Comprobantes Fallidos:</h2>
    @foreach ($failedVouchers as $comprobante)
    <ul>
        <li>Contenido XML: {{ $comprobante['xmlContent'] }}</li>
        <li>Razón: {{ $comprobante['reason'] }}</li>
    </ul>
    @endforeach

    <p>¡Gracias por usar nuestro servicio!</p>
</body>
</html>
