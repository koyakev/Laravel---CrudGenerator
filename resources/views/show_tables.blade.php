<div>
    <a href="{{ route('create_view') }}">Create Table</a>
    <table>
        <thead>
            <tr>
                <th>Table Name</th>
                <th>Columns</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tables as $table)
                <tr>
                    <td>
                        <a href="{{ route('show_table', $table->id) }}">{{ $table->title }}</a>
                    </td>
                    <td>
                        @if($table->columns != NULL)
                            Migrated
                        @else
                            Not Migrated
                        @endif
                    </td>
                    <td>
                        <form method="POST" action="{{ route('delete_table', $table->id) }}">
                            @csrf
                            @method("DELETE")
                            <button>Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
