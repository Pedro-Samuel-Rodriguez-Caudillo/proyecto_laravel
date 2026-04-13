<h1> {{ 'Mis productos' }} </h1>
<ul>
    @foreach($product as $pr)
        <li>{{ $pr['Name'] }}</li>
    @endforeach
</ul>
