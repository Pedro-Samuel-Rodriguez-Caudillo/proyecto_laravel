@vite(['resources/js/app.js'])

<style>
    div {
        padding: 20px;
        margin: 5px;
    }
</style>

<h1>Lista de Datos de la API</h1>

@foreach($enlace as $dato)
    <div style="border:1px solid #1f2937">
        <li>
            {{ $dato['Name'] ?? 'No lo encontré' }}
            <button
                type="button"
                onclick="saludar('{{ addslashes($dato['Name'] ?? 'Sin nombre') }}','{{ addslashes($dato['Description'] ?? 'Sin descripción') }}')"
                class="btn btn-success">
                Ver descripción
            </button>
            <a href="{{ route('tj.detalle', $dato['Name']) }}">
                Ir a detalles
            </a>
        </li>
    </div>
@endforeach

