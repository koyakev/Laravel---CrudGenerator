<div>
    @php
        $columns = json_decode($table[0]->columns);
    @endphp
    

    <form method="POST" action="{{ route('store_to_table', [$table[0]->id, $table[0]->title]) }}">
        @csrf
        @foreach($columns as $column)
            @switch($column->datatype)

                @case('string')
                    <input type="text" name={{ $column->title }} placeholder={{ $column->title }}>
                @break

                @case('text')
                    <textarea name={{ $column->title }} placeholder={{ $column->title }}></textarea>
                @break

                @case('integer')
                    <input type="number" name={{ $column->title }} placeholder={{ $column->title }}>
                @break

                @case('float')
                    <input type="number" step=0.01 name={{ $column->title }} placeholder={{ $column->title }}>
                @break

                @case('boolean')
                    <input type="checkbox" name={{ $column->title }} id={{ $column->title }} value=1><label for={{ $column->title }}>{{ $column->title }}</label>
                @break

            @endswitch
        @endforeach
        <button>Add</button>
    </form>
</div>
