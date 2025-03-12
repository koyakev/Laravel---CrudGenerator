<div>
    <form method="POST" action="{{ route('create_table') }}">
        @csrf
        <input type="text" name="title">
        <input type="number" name="column_number">
        <button type="submit">Create table</button>
    </form>
    <a href="{{ route('show_tables') }}">Show Tables</a>
</div>
