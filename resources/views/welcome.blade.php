<!DOCTYPE html>
<html>
<head>
    <title>KWM Corona</title>
</head>
<body>
<ul>
    @foreach($locations as $location)
        <li>{{$location->zipcode}} {{$location->city}}</li>
        @endforeach
</ul>
</body>
</html>
