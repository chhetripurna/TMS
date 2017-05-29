<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;

	class AdminVisit24Controller extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "id";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = true;
			$this->button_action_style = "button_icon";
			$this->button_add = true;
			$this->button_edit = true;
			$this->button_delete = true;
			$this->button_detail = true;
			$this->button_show = true;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "visit";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Name","name"=>"Name"];
			$this->col[] = ["label"=>"Patient CID","name"=>"CID"];
			$this->col[] = ["label"=>"Patient ID","name"=>"Patient_Register_ID"];
			$this->col[] = ["label"=>"Visit Date","name"=>"admitDate"];
			
			$this->col[] = ["label"=>"Bed Number","name"=>"Bed_Num","join"=>"bed,Bed_No"];
			$this->col[] = ["label"=>"Level","name"=>"level"];
			//$this->col[] = ["label"=>"Visit time's","name"=>"(select count(id) from visit where  Patient_Register_ID = patient.id) as vno"];
			$this->col[] = ["label"=>"Status","name"=>"is_active","callback_php"=>'($row->is_active=="Examined")?"<span class=\"label label-success\">Examined</span>":"<span class=\"label label-danger\">Pending</span>"'];
			# END COLUMNS DO NOT REMOVE THIS LINE


			
			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];

			//$this->form[] = ['label'=>'Select Patient','name'=>'Patient_Register_ID','type'=>'datamodal','readonly'=>true,'width'=>'col-sm-6','datamodal_table'=>'patient','datamodal_columns'=>'Name,CID,Contact','datamodal_columns_alias'=>'Name,CID,Contact No','datamodal_select_to'=>'Name:Name,CID:CID','datamodal_size'=>'small'];
			
			//Get the patient data, where id equal with get id patient
			//Put some value to the add form

		if(!Request::get('id')) {
		$this->form[] = ['label'=>'Select Patient','name'=>'Patient_Register_ID','type'=>'datamodal','readonly'=>true,'width'=>'col-sm-6','datamodal_table'=>'patient','datamodal_columns'=>'Name,CID,Contact','datamodal_columns_alias'=>'Name,CID,Contact No','datamodal_select_to'=>'Name:Name,CID:CID,id:Patient_Register_ID','datamodal_size'=>'small'];
			}


			$patient = DB::table('patient')->where('id', Request::get('id'))->first();

			if(CRUDBooster::getCurrentMethod() == 'getAdd') {
			$this->form[] = ['label'=>'CID','type'=>'text','name'=>'CID','value'=>$patient->CID,'readonly'=>true,'width'=>'col-sm-6'];
			}else {
			$this->form[] = ['label'=>'CID','type'=>'text','name'=>'CID','readonly'=>true,'width'=>'col-sm-6'];
				}

				if(CRUDBooster::getCurrentMethod() == 'getAdd') {
			$this->form[] = ['label'=>'Name','type'=>'text','name'=>'Name','value'=>$patient->Name,'readonly'=>true,'width'=>'col-sm-6'];
			}else {
			$this->form[] = ['label'=>'Name','type'=>'text','name'=>'Name','readonly'=>true,'width'=>'col-sm-6'];
				}
				if(CRUDBooster::getCurrentMethod() == 'getAdd') {
			$this->form[] = ['label'=>'Patient ID','type'=>'text','name'=>'Patient_Register_ID','value'=>$patient->id,'readonly'=>true,'width'=>'col-sm-6'];
			}else {
			$this->form[] = ['label'=>'Patient ID','type'=>'text','name'=>'Patient_Register_ID','readonly'=>true,'width'=>'col-sm-6'];
				}
	
			//$this->form[] = ['label'=>'Name','name'=>'Name','value'=>$Name,'patient','readonly'=>true,'width'=>'col-sm-6'];
			

			//$this->form[] = ['label'=>'Name','name'=>'Patient_Register_ID','type'=>'text','value'=>$CurrentUser=DB::table('patient')->where('id',CRUDBooster::myId())->first()];
			//$this->form[] = ['label'=>'Room No','name'=>'Room_Num','type'=>'select','validation'=>'required|min:0','width'=>'col-sm-6','datatable'=>'room,Room_No'];
			//$this->form[] = ['label'=>'Bed No','name'=>'Bed_Num','type'=>'select','validation'=>'required|min:0','width'=>'col-sm-6','datatable'=>'bed,Bed_No','datatable_where'=>'Status!="Occupied"','parent_select'=>'Room_Num'];
			$this->form[] = ['label'=>'Bed No','name'=>'Bed_Num','type'=>'select','validation'=>'min:0','width'=>'col-sm-5','datatable'=>'bed,Bed_No','datatable_where'=>'Status!="Occupied"'];
			$this->form[] = ['label'=>'Level','name'=>'level','type'=>'radio','validation'=>'required','width'=>'col-sm-6','dataenum'=>'Level I;Level II; Level III; Level IV'];
			$this->form[] = ['label'=>'Others','name'=>'OPD','type'=>'checkbox','width'=>'col-sm-6','dataenum'=>'Dressing ;PBE;OPD'];
			$this->form[] = ['label'=>'Reffer From','name'=>'Reffer_From', 'type'=>'text','width'=>'col-sm-6','validation'=>'alpha_spaces','placeholder'=>'You can enter letter only'];


			$this->form[] = ['label'=>'Triage','name'=>'Patient_Register_ID','type'=>'header','width'=>'col-sm-9'];
			$this->form[] = ['label'=>'Blood Presure','name'=>'BloodPresure','type'=>'text','width'=>'col-sm-6','validation'=>'numeric|min:60|max:250','placeholder'=>'You can enter only number'];
			$this->form[] = ['label'=>'Heart Rate','name'=>'HeartRate','type'=>'text','width'=>'col-sm-6','validation'=>'numeric|min:40|max:220','placeholder'=>'You can enter only number'];
			$this->form[] = ['label'=>'Temperature','name'=>'Temperature','type'=>'text','width'=>'col-sm-6'];
			$this->form[] = ['label'=>'SpO2','name'=>'SpO2','type'=>'text','width'=>'col-sm-6'];
			$this->form[] = ['label'=>'Rbs','name'=>'Rbs','type'=>'text','width'=>'col-sm-6'];
			$this->form[] = ['label'=>'Respiration','name'=>'Respiration','type'=>'text','width'=>'col-sm-6'];
			$this->form[] = ['label'=>'Allergies','name'=>'Allergies','type'=>'text','width'=>'col-sm-6'];
			$this->form[] = ['label'=>'GCSScore','name'=>'GCSScore','type'=>'text','width'=>'col-sm-6'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ['label'=>'Patient CID','name'=>'Patient_Register_ID','type'=>'datamodal','validation'=>'required','width'=>'col-sm-6','datamodal_table'=>'patient','datamodal_columns'=>'CID,First_Name,Last_Name','datamodal_columns_alias'=>'CID,First Name,Last Name','datamodal_size'=>'small'];
			//$this->form[] = ['label'=>'Room No','name'=>'Room_Num','type'=>'select','validation'=>'required|min:0','width'=>'col-sm-6','datatable'=>'room,Room_No'];
			//$this->form[] = ['label'=>'Bed No','name'=>'Bed_Num','type'=>'select','validation'=>'required|min:0','width'=>'col-sm-6','datatable'=>'bed,Bed_No','datatable_where'=>'Status!="Occupied"','parent_select'=>'Room_Num'];
			//$this->form[] = ['label'=>'Level','name'=>'level','type'=>'radio','validation'=>'required','width'=>'col-sm-6','dataenum'=>'Immediate;Urgent; Delay; Death'];
			//$this->form[] = ['label'=>'Triage','name'=>'id','width'=>'col-sm-9'];
			//$this->form[] = ['label'=>'Blood Presure','name'=>'BloodPresure','type'=>'text','width'=>'col-sm-6'];
			//$this->form[] = ['label'=>'Heart Rate','name'=>'HeartRate','type'=>'text','width'=>'col-sm-6'];
			//$this->form[] = ['label'=>'Temperature','name'=>'Temperature','type'=>'text','width'=>'col-sm-6'];
			//$this->form[] = ['label'=>'SpO2','name'=>'SpO2','type'=>'text','width'=>'col-sm-6'];
			//$this->form[] = ['label'=>'Rbs','name'=>'Rbs','type'=>'text','width'=>'col-sm-6'];
			//$this->form[] = ['label'=>'Respiration','name'=>'Respiration','type'=>'text','width'=>'col-sm-6'];
			//$this->form[] = ['label'=>'Allergies','name'=>'Allergies','type'=>'text','width'=>'col-sm-6'];
			//$this->form[] = ['label'=>'GCSScore','name'=>'GCSScore','type'=>'text','width'=>'col-sm-6'];
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
	       //	$this->sub_module [] = ['label'=>'Doctor Notes', 'path'=>'prescription', 'parent_columns'=>'id,cid,level','foreign_key'=>'id', 'button_color'=>'success', 'button_icon'=>'fa fa-bars'];

	          $this->addaction[] = ['label'=>'Create Visit','url'=>CRUDBooster::adminPath('visit2/add?id=[id]'),'icon'=>'fa fa-check','color'=>'success'];
	         

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
	        $this->addaction[] = ['label'=>'Set Pending','url'=>CRUDBooster::mainpath('set-status/Pending/[id]'),'icon'=>'fa fa-ban','color'=>'warning','showIf'=>"[is_active] == 'Examined'"];

	   

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
	         $this->alert[] = ["message"=>"List Of Patient Visited","type"=>"info"];

	                

	        
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
	         $this->table_row_color[] = ['condition'=>"[is_active] == 'Examined'","color"=>"success"];  
	        $this->table_row_color[] = ['condition'=>"[is_active] == 'Pending'","color"=>"warning"];       	          

	        
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
	             $query->where('is_active',0);
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
	          $bed = CRUDBooster::first('bed',Request::get('Bed_Num'));
	    	//$prescription = $visit->prescription + Request::get('Bed_Num') - Request::get('Level');
	    	DB::table('bed')->where('id',Request::get('Bed_Num'))->update(['Status'=>Occupied]);


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

	   // public function array($row){
	    	//$currentUser = DB::table('cms_users')->where('id',CRUDBooster::myId())->first();
	  //  }

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


//update the status when we click on set pending
public function getSetStatus($is_active,$id) {
   DB::table('visit')->where('id',$id)->update(['is_active'=>$is_active]);
   
   //This will redirect back and gives a message
   CRUDBooster::redirect($_SERVER['HTTP_REFERER'],"Status has been updated to Pending!","success");
}

	    //By the way, you can still create your own method in here... :) 


	


}