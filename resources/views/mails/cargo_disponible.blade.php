<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Cargo disponible para retiro</title>
    <style>
        .resaltado{
            background-color: yellow;
        }
        .detalle{
            margin-top: 20px;
            padding: 10px, 5px, 10px, 5px;
            border: 1px solid black;
            width: 280px;
            background-color: lightgreen;
        }
        .detalle p {
            font-size: 16px;
            padding-left: 30px;
        }
    </style>
</head>
<body>
<p>Estimado, junto con saludar, informo material arribado a bodega disponible para su retiro <b>OC {{$cargo->nro_contable}}</b></p>
<span class="resaltado"><b>Favor gestionar reserva para el retiro</b></span>

<div class="detalle">
    <p><b>Detalle</b></p>
    <ul>
        <li><b>Cantidad:</b> {{$cargo->stock_actual}}</li>
        <li><b>Lote:</b> {{$cargo->lote}}</li>
        <li><b>Movimiento contable:</b> 502</li>
        <li><b>Código Genérico:</b> {{$cargo->nro_contable}}</li>
    </ul>
</div>


</body>
</html>