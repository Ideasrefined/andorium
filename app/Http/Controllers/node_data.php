<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Schema;
use App\sensorNode;
use App\parent_table;
use App\data_table;
use Illuminate\Http\Request;

class node_data extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $node_id = $request->node_id;

        $node_name = $request->node_name;
        $table_name = "node_" . $node_id;
        $parent_table = "SensorNodes";
        
        //if sensorNodes table does not exist.
        if(! Schema::hasTable($parent_table))
        {
            //create sensor nodes table
            Schema::create($parent_table, function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
            
            $table->string('data1_name')->nullable();
            $table->string('data1_unit')->nullable();

            $table->string('data2_name')->nullable();
            $table->string('data2_unit')->nullable();

             $table->string('data3_name')->nullable();
            $table->string('data3_unit')->nullable();

            $table->string('data4_name')->nullable();
            $table->string('data4_unit')->nullable();

            $table->string('data5_name')->nullable();
            $table->string('data5_unit')->nullable();

            $table->string('data6_name')->nullable();
            $table->string('data6_unit')->nullable();

            $table->string('data_table_name');
            });
            //return "Creating Parent Table " . $parent_table;
        }
        
    
        $parent_data = new parent_table;
        $parent_data->setTable($parent_table);  

        $parent_data->name = $node_name;
        $parent_data->data_table_name = $table_name;
        $parent_data->data1_name = $request->data1_name;
        $parent_data->data2_name = $request->data2_name;
        $parent_data->data3_name = $request->data3_name;
        $parent_data->data4_name = $request->data4_name;
        $parent_data->data5_name = $request->data5_name;
        $parent_data->data6_name = $request->data6_name;

        $parent_data->data1_unit = $request->data1_unit;
        $parent_data->data2_unit = $request->data2_unit;
        $parent_data->data3_unit = $request->data3_unit;
        $parent_data->data4_unit = $request->data4_unit;
        $parent_data->data5_unit = $request->data5_unit;
        $parent_data->data6_unit = $request->data6_unit;
        
        $parent_data->save();
        
        
       
    
        if(! Schema::hasTable($table_name))
        {
            //parent table already exists. just create data entry table
            Schema::create($table_name, function ($table) {
            $table->increments('id');
            //$table->integer('node_id');         //node id to which this data relates to
            $table->string('data1')->nullable();
          

            $table->string('data2')->nullable();
          
            
            $table->string('data3')->nullable();
           
            
            $table->string('data4')->nullable();
           
            
            $table->string('data5')->nullable();
          
            
            $table->string('data6')->nullable();
          
            
            $table->timestamps();
            });

            return "Creating Data table " . $table_name;
        }    
        else
        {
             return "Sensor Node already exists";
        }
                

        
       
        
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $node_id)
    {
        //
        $data_table = new data_table;;
        $table_name = 'node_' . $node_id;

        $data_table->setTable($table_name);

        $data_table->data1 = $request->data1;
        $data_table->data2 = $request->data2;
        $data_table->data3 = $request->data3;
        $data_table->data4 = $request->data4;
        $data_table->data5 = $request->data5;
        $data_table->data6 = $request->data6;

        $data_table->save();

        return "data Saved";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\sensorNode  $sensorNode
     * @return \Illuminate\Http\Response
     */
    public function show(sensorNode $sensorNode, $node_id)
    {
        //
        $sensorNode = new sensorNode;
        $table_name = 'node_' . $node_id;
        $parent_table = "SensorNodes";

        $sensorNode->setTable($table_name);

        $SensorData = $sensorNode->get();

        $parent_data = new parent_table;
        $parent_data->setTable($parent_table);
        //$parent_data->has($sensorNode);
        $data = $parent_data->where('data_table_name',$table_name)->get();
        

        return response()->json([
            'node'=>$data , 
            'data'=>$SensorData]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\sensorNode  $sensorNode
     * @return \Illuminate\Http\Response
     */
    public function edit(sensorNode $sensorNode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\sensorNode  $sensorNode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, sensorNode $sensorNode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\sensorNode  $sensorNode
     * @return \Illuminate\Http\Response
     */
    public function destroy(sensorNode $sensorNode)
    {
        //
    }
}