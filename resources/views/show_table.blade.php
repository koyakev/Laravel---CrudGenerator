<div>
    @if(is_null($table_info->columns))
        <form method="POST" action="{{ route('migrate_table', $table_info->id) }}">
            @csrf
            @for($i = 0; $i < $table_info->column_number; $i++)
                <input type="text" name="{{ 'column_' . $i }}">
                <select name="{{ 'datatype_' . $i }}">
                    <option value="string">Short Text</option>
                    <option value="text">Long Text</option>
                    <option value="integer">Number</option>
                    <option value="float">Decimal</option>
                    <option value="boolean">True or False</option>
                </select>
            @endfor
            <button>Migrate Table</button>
        </form>
    @else
        <a href="{{ route('add_to_table', $table_info->id) }}">Add</a>
        <table>
            <thead>
                <tr>
                    @foreach($columns as $column)
                        <th>{{ $column }}</th>
                    @endforeach
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($table as $table)
                    <tr>
                        @foreach($columns as $column)
                            <td>{{ $table->$column }}</td>
                        @endforeach
                        <td>
                            <form method="POST" action="{{ route('delete_from_table', [$table_info->id, $table_info->title, $table->id]) }}">
                                @csrf
                                @method('DELETE')
                                <button>Delete</button>
                            </form>
                            <a href="{{ route('edit_from_table', [$table_info->id, $table_info->title, $table->id]) }}">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
