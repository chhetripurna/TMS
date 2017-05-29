<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;

	class AdminTraumaController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "id";
			$this->limit = "10";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = false;
			$this->button_action_style = "button_icon";
			$this->button_add = true;
			$this->button_edit = true;
			$this->button_delete = true;
			$this->button_detail = true;
			$this->button_show = false;
			$this->button_filter = false;
			$this->button_import = false;
			$this->button_export = true;
			$this->table = "trauma";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Name","name"=>"Name"];
			$this->col[] = ["label"=>"Patient ID","name"=>"Patient_ID"];
			$this->col[] = ["label"=>"Injured","name"=>"injured"];
			$this->col[] = ["label"=>"Time","name"=>"time"];
			$this->col[] = ["label"=>"Setting","name"=>"setting"];
			$this->col[] = ["label"=>"Intent","name"=>"intent"];
			$this->col[] = ["label"=>"Substance involved","name"=>"substance"];
			$this->col[] = ["label"=>"Cut/Pierce","name"=>"cut"];
			$this->col[] = ["label"=>"Struck","name"=>"struck"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];


			$this->form[] = ['label'=>'Select Patient','name'=>'id','type'=>'datamodal','readonly'=>true,'width'=>'col-sm-6','datamodal_table'=>'visit','datamodal_columns'=>'Name,Patient_Register_ID','datamodal_columns_alias'=>'Name,Patient ID','datamodal_select_to'=>'Name:Name,Patient_Register_ID:Patient_ID','datamodal_size'=>'small'];
		
			//$this->form[] = ['label'=>'Name', 'name'=> 'CID','type'=>'number','width'=>'col-sm-6','readonly'=>true,'value'=>$Name];

			$patient = DB::table('visit')->where('id', Request::get('id'))->first();

			if(CRUDBooster::getCurrentMethod() == 'getAdd') {
			$this->form[] = ['label'=>'Patient ID','type'=>'text','name'=>'Patient_ID','value'=>$patient->id,'readonly'=>true,'width'=>'col-sm-6'];
			}else {
			$this->form[] = ['label'=>'Patient ID','type'=>'text','name'=>'Patient_ID','readonly'=>true,'width'=>'col-sm-6'];
				}

				if(CRUDBooster::getCurrentMethod() == 'getAdd') {
			$this->form[] = ['label'=>'Name','type'=>'text','name'=>'Name','value'=>$patient->Name,'readonly'=>true,'width'=>'col-sm-6'];
			}else {
			$this->form[] = ['label'=>'Name','type'=>'text','name'=>'Name','readonly'=>true,'width'=>'col-sm-6'];
				}

			$this->form[] = ['label'=>'Body Part Injured','name'=>'injured','type'=>'checkbox','width'=>'col-sm-10','dataenum'=>'Eyes;Chest;Head/Neck;Abdomen/Lower Part;Extremity/Pelvis'];
			$this->form[] = ['label'=>'Time from incident to Arrival at JDWNRH(hr)','name'=>'time','type'=>'text','width'=>'col-sm-5'];
			$this->form[] = ['label'=>'Setting','name'=>'setting','type'=>'radio','width'=>'col-sm-10','dataenum'=>'Work;Home;School;Sport;Road;Others'];
			$this->form[] = ['label'=>'Intent','name'=>'intent','type'=>'radio','width'=>'col-sm-10','dataenum'=>'Unintentional;Assault/Homicide;Intentionalself harm;Undetermined;Others'];
			$this->form[] = ['label'=>'Substance involved','name'=>'substance','type'=>'checkbox','width'=>'col-sm-10','dataenum'=>'Alcohol;Drugs;None'];
			$this->form[] = ['label'=>'Cut/Pierce','name'=>'cut','type'=>'checkbox','width'=>'col-sm-10','dataenum'=>'Knife/Sword/Dragger;Hand tools;Foreign body;Arrow;Others'];
			$this->form[] = ['label'=>'Struck','name'=>'struck','type'=>'radio','width'=>'col-sm-10','dataenum'=>'Thrown/Projected/Falling Object;At Sports Events;By person;Others'];
			$this->form[] = ['label'=>'Fall From','name'=>'fallFrom','type'=>'radio','width'=>'col-sm-10','dataenum'=>'Standing;Building;Cliff;Tree;Stairs;Others/Unknown'];
			$this->form[] = ['label'=>'Approximate Height (M)','name'=>'height','type'=>'text','width'=>'col-sm-5'];
			$this->form[] = ['label'=>'Burn','name'=>'burn','type'=>'radio','width'=>'col-sm-10','dataenum'=>'Flame/Fire;Contact w/Hot Object;Chemical;Electrical;Scald;Others'];
			$this->form[] = ['label'=>'Fiream','name'=>'fiream','type'=>'radio','width'=>'col-sm-10','dataenum'=>'Head Gun;Rifle/Shot Gun;Others'];
			$this->form[] = ['label'=>'Machinery','name'=>'machinery','type'=>'radio','width'=>'col-sm-10','dataenum'=>'Agriculture;Construction;Industry;Others'];
			$this->form[] = ['label'=>'Transportation','name'=>'transportation','type'=>'radio','width'=>'col-sm-10','dataenum'=>'Car Passenger;Car Driver;Pedestrian;pedal Cyclist;Motorcycle;Others'];
			$this->form[] = ['label'=>'Natural/Environmental/ Animal','name'=>'naturalEnvi','type'=>'radio','width'=>'col-sm-10','dataenum'=>'Snake;Dog;Poisonous plant;Hyperthermia/Hypothermia;Bear Maul;Bull Gore'];
			$this->form[] = ['label'=>'Asphyxia','name'=>'asphyxia','type'=>'checkbox','width'=>'col-sm-10','dataenum'=>'Strangulation/Hanging;Aspiration;Suffocation;Traumatic;Unspecified;Others'];
			$this->form[] = ['label'=>'Drowning','name'=>'drowning','type'=>'radio','width'=>'col-sm-10','dataenum'=>'Natural;Man Made;Unspecified'];
			$this->form[] = ['label'=>'Others','name'=>'others','type'=>'text','width'=>'col-sm-6'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ['label'=>'Injured','name'=>'injured','type'=>'checkbox','width'=>'col-sm-10','dataenum'=>'Eyes;Chest;Head/Neck;Abdomen/Lower Part;Extremity/Pelvis'];
			//$this->form[] = ['label'=>'Time','name'=>'time','type'=>'time','width'=>'col-sm-5'];
			//$this->form[] = ['label'=>'Setting','name'=>'setting','type'=>'radio','width'=>'col-sm-10','dataenum'=>'Work;Home;School;Sport;Road;Others'];
			//$this->form[] = ['label'=>'Intent','name'=>'intent','type'=>'radio','width'=>'col-sm-10','dataenum'=>'Unintentional;Assault/Homicide;Intentionalself harm;Undetermined;Others'];
			//$this->form[] = ['label'=>'Substance','name'=>'substance','type'=>'checkbox','width'=>'col-sm-10','dataenum'=>'Alcohol;Drugs;None'];
			//$this->form[] = ['label'=>'Cut','name'=>'cut','type'=>'checkbox','width'=>'col-sm-10','dataenum'=>'Knife/Sword/Dragger;Hand tools;Foreign body;Arrow;Others'];
			//$this->form[] = ['label'=>'Struck','name'=>'struck','type'=>'text','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'FallFrom','name'=>'fallFrom','type'=>'radio','width'=>'col-sm-10','dataenum'=>'Thrown/Projected/Falling Object;At Sports Events;By person;Others'];
			//$this->form[] = ['label'=>'Height','name'=>'height','type'=>'text','width'=>'col-sm-5'];
			//$this->form[] = ['label'=>'Burn','name'=>'burn','type'=>'radio','width'=>'col-sm-10','dataenum'=>'Flame/Fire;Contact w/Hot Object;Chemical;Electrical;Scald;Others'];
			//$this->form[] = ['label'=>'Fiream','name'=>'fiream','type'=>'radio','width'=>'col-sm-10','dataenum'=>'Head Gun;Rifle/Shot Gun;Others'];
			//$this->form[] = ['label'=>'Machinery','name'=>'machinery','type'=>'radio','width'=>'col-sm-10','dataenum'=>'Agriculture;Construction;Industry;Others'];
			//$this->form[] = ['label'=>'Transportation','name'=>'transportation','type'=>'radio','width'=>'col-sm-10','dataenum'=>'Car Passenger;Car Driver;Pedestrian;pedal Cyclist;Motorcycle;Others'];
			//$this->form[] = ['label'=>'NaturalEnvi','name'=>'naturalEnvi','type'=>'radio','width'=>'col-sm-10','dataenum'=>'Snake;Dog;Poisonous plant;Hyperthermia/Hypothermia;Bear Maul;Bull Gore'];
			//$this->form[] = ['label'=>'Asphyxia','name'=>'asphyxia','type'=>'checkbox','width'=>'col-sm-10','dataenum'=>'Strangulation/Hanging;Aspiration;Suffocation;Traumatic;Unspecified;Others'];
			//$this->form[] = ['label'=>'Drowning','name'=>'drowning','type'=>'radio','width'=>'col-sm-10','dataenum'=>'Natural;Man Made;Unspecified'];
			//$this->form[] = ['label'=>'Others','name'=>'others','type'=>'text','width'=>'col-sm-6'];
			# OLD END FORM

			/* 
	        | ---------------------------------------------------------------------- 
	        | Sub Module
	        | ----------------------------------------------------------------------     
			| @label          = Label of action 
			| @path           = Path of sub module
			| @foreign_key 	  = foreign key of sub table/module
			| @button_color   = Bootstrap Class (primary,success,warning,danger)
			| @button_icon    = Font Awesome Class  
			| @parent_columns = Sparate with comma, e.g : name,created_at
	        | 
	        */
	        $this->sub_module = array();


	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add More Action Button / Menu
	        | ----------------------------------------------------------------------     
	        | @label       = Label of action 
	        | @url         = Target URL, you can use field alias. e.g : [id], [name], [title], etc
	        | @icon        = Font awesome class icon. e.g : fa fa-bars
	        | @color 	   = Default is primary. (primary, warning, succecss, info)     
	        | @showIf 	   = If condition when action show. Use field alias. e.g : [id] == 1
	        | 
	        */
	        $this->addaction = array();


	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add More Button Selected
	        | ----------------------------------------------------------------------     
	        | @label       = Label of action 
	        | @icon 	   = Icon from fontawesome
	        | @name 	   = Name of button 
	        | Then about the action, you should code at actionButtonSelected method 
	        | 
	        */
	        $this->button_selected = array();

	                
	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add alert message to this module at overheader
	        | ----------------------------------------------------------------------     
	        | @message = Text of message 
	        | @type    = warning,success,danger,info        
	        | 
	        */
	        $this->alert        = array();
	                

	        
	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add more button to header button 
	        | ----------------------------------------------------------------------     
	        | @label = Name of button 
	        | @url   = URL Target
	        | @icon  = Icon from Awesome.
	        | 
	        */
	        $this->index_button = array();



	        /* 
	        | ---------------------------------------------------------------------- 
	        | Customize Table Row Color
	        | ----------------------------------------------------------------------     
	        | @condition = If condition. You may use field alias. E.g : [id] == 1
	        | @color = Default is none. You can use bootstrap success,info,warning,danger,primary.        
	        | 
	        */
	        $this->table_row_color = array();     	          

	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | You may use this bellow array to add statistic at dashboard 
	        | ---------------------------------------------------------------------- 
	        | @label, @count, @icon, @color 
	        |
	        */
	        $this->index_statistic = array();



	        /*
	        | ---------------------------------------------------------------------- 
	        | Add javascript at body 
	        | ---------------------------------------------------------------------- 
	        | javascript code in the variable 
	        | $this->script_js = "function() { ... }";
	        |
	        */
	        $this->script_js = NULL;


            /*
	        | ---------------------------------------------------------------------- 
	        | Include HTML Code before index table 
	        | ---------------------------------------------------------------------- 
	        | html code to display it before index table
	        | $this->pre_index_html = "<p>test</p>";
	        |
	        */
	        $this->pre_index_html = null;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include HTML Code after index table 
	        | ---------------------------------------------------------------------- 
	        | html code to display it after index table
	        | $this->post_index_html = "<p>test</p>";
	        |
	        */
	        $this->post_index_html = null;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include Javascript File 
	        | ---------------------------------------------------------------------- 
	        | URL of your javascript each array 
	        | $this->load_js[] = asset("myfile.js");
	        |
	        */
	        $this->load_js = array();
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Add css style at body 
	        | ---------------------------------------------------------------------- 
	        | css code in the variable 
	        | $this->style_css = ".style{....}";
	        |
	        */
	        $this->style_css = NULL;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include css File 
	        | ---------------------------------------------------------------------- 
	        | URL of your css each array 
	        | $this->load_css[] = asset("myfile.css");
	        |
	        */
	        $this->load_css = array();
	        
	        
	    }


	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for button selected
	    | ---------------------------------------------------------------------- 
	    | @id_selected = the id selected
	    | @button_name = the name of button
	    |
	    */
	    public function actionButtonSelected($id_selected,$button_name) {
	        //Your code here
	            
	    }


	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate query of index result 
	    | ---------------------------------------------------------------------- 
	    | @query = current sql query 
	    |
	    */
	    public function hook_query_index(&$query) {
	        //Your code here
	            
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate row of index table html 
	    | ---------------------------------------------------------------------- 
	    |
	    */    
	    public function hook_row_index($column_index,&$column_value) {	        
	    	//Your code here
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before add data is execute
	    | ---------------------------------------------------------------------- 
	    | @arr
	    |
	    */
	    public function hook_before_add(&$postdata) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after add public static function called 
	    | ---------------------------------------------------------------------- 
	    | @id = last insert id
	    | 
	    */
	    public function hook_after_add($id) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before update data is execute
	    | ---------------------------------------------------------------------- 
	    | @postdata = input post data 
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_edit(&$postdata,$id) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after edit public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_edit($id) {
	        //Your code here 

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command before delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_delete($id) {
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_delete($id) {
	        //Your code here

	    }



	    //By the way, you can still create your own method in here... :) 


	}