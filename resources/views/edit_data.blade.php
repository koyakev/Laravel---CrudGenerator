<div>
    @php
        $columns = json_decode($table->columns);
    @endphp

    <form method="POST" action="{{ route('update_from_table', [$table->id, $table->title, $data[0]->id]) }}">
        @csrf
        @method("PUT")
        @foreach($columns as $column)
            @switch($column->datatype)
                @case('string')
                    <input type="text" name="{{ $column->title }}" value={{ $data[0]->{$column->title} }} />
                @break
                @case('text')
                    <textarea name="{{ $column->title }}">{{ $data[0]->{$column->title} }}</textarea>
                @break
                @case('integer')
                    <input type="number" name="{{ $column->title }}" value={{ $data[0]->{$column->title} }} />
                @break
                @case('float')
                    <input type="number" step=0.01 name="{{ $column->title }}" value={{ $data[0]->{$column->title} }} />
                @break
                @case('boolean')
                    <input type="hidden" name="{{ $column->title }}" value=0>
                    <input type="checkbox" name="{{ $column->title }}" id="{{ $column->title }}" value=1 {{ $data[0]->{$column->title} == 1 ? 'checked' : ''; }}><label for={{ $column->title }}>{{ $column->title }}</label>
                @break
            @endswitch
        @endforeach
        <button>Update</button>
    </form>
</div>
