<!DOCTYPE html>
<html>
<head>
    <title>KWM Corona</title>
</head>
<body>
<ul>
    @foreach($locations as $location)
        <li><a href="locations/{{$location->id}}">{{$location->city}} {{$location->address}}</a></li>
    @endforeach
</ul>
</body>
</html>
