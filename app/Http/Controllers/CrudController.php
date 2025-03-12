<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;

class CrudController extends Controller
{
    public function create_view() {
        return view('create_table');
    }

    public function create_table(Request $request) {
        Table::create($request->all());
        return redirect()->route('create_view');
    }

    public function show_tables() {
        $tables = Table::all();
        return view('show_tables', compact('tables'));
    }

    public function show_table($id) {
        $table_info = Table::find($id);
        
        if(!is_null($table_info->columns)) {
            $table = DB::table($table_info->title)->get();

            $columns = Schema::getColumnListing($table_info->title);

            return view('show_table', compact(['table', 'table_info', 'columns']));
        } else {
            return view('show_table', compact('table_info'));
        }
    }

    public function migrate_table(Request $request, $id) {
        $table_create = Table::find($id);
        $fields = [];

        for($i = 0; $i < $table_create->column_number; $i++) {
            $fields[] = [
                "title" => $request["column_$i"],
                "datatype" => $request["datatype_$i"]
            ];
        }

        $table_create->columns = $fields;
        $table_create->save();

        Schema::create($table_create->title, function(Blueprint $table) use ($fields) {
            $table->id();
            foreach($fields as $field) {
                switch($field["datatype"]) {
                    case "string":
                        $table->string($field["title"]);
                    break;

                    case "text":
                        $table->text($field["title"]);
                    break;

                    case "integer":
                        $table->integer($field["title"]);
                    break;

                    case "float":
                        $table->float($field["title"], 8, 2);
                    break;

                    case "boolean":
                        $table->boolean($field["title"]);
                    break;
                }
            }
            $table->timestamps();
        });

        return redirect()->route('show_tables');
    }

    public function delete_table($id) {
        $table = Table::find($id);
        $table->delete();
        return redirect()->route('show_tables');
    }

    public function add_to_table($table_id) {
        $table = Table::find($table_id)->get();

        return view('add_to_table', compact('table'));
    }

    public function store_to_table(Request $request, $table_id, $table_name) {
        DB::table($table_name)->insert([
            'name' => $request->name,
            'age' => $request->age,
            'status' => $request->status == 1 ? 1 : 0
        ]); 
        return redirect()->route('show_table', $table_id);
    }

    public function delete_from_table($table_id, $table_name, $id) {
        DB::table($table_name)->where('id', $id)->delete();
        return redirect()->route('show_table', $table_id);
    }

    public function edit_from_table($table_id, $table_name, $id) {
        $data = DB::table($table_name)->where('id', $id)->get();
        return view('edit_data', compact('data'));
    }
}
