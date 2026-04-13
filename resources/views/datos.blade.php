<style>
    div {
        padding: 20px;
        margin:5px
    }
</style><h1>Lista de Datos de la API</h1>


@foreach($enlace as $dato)
    <div style="border:1px solid #1f2937">
        <li>{{ $dato['Name'] ?? 'No lo encontre' }}
            <ul>
                Descripcion: {{ $dato['Description'] }}
            </ul>
        </li>
    </div>
@endforeach

