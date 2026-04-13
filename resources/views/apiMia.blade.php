<style>
    div {
        padding: 20px;
        margin: 5px;
    }
</style>
<h1>Lista de Datos - API Mia</h1>

@foreach($enlace as $dato)
    <div style="border:1px solid #1f2937">
        <h2> titulo: {{ $dato['title'] }}
        </h2>

        <p>{{$dato['body']}}}</p>

    </div>

@endforeach
