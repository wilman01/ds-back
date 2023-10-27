<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Cotización de Salud</h1>
<p>Hola {{$health->customer->name}} {{$health->customer->last_name}}, has solicitado una cotización de:</p>
<p>Póliza de salud: {{$health->policy->name}}.</p>

{{--@if(! $health->ages->isEmpty())--}}

<h3>Familiares agregados:</h3>
<ul>
@foreach($health->ages as $age)
    <li>En el grupo etario {{$age->group}} años de edad, la cantidad de {{$age->pivot->quantity}} familiares.</li>
@endforeach
</ul>

{{--@endif--}}
<p>El monto de tu póliza es: <strong>1200,00 Bs</strong> anuales.</p>
<p></p>
</body>
</html>
