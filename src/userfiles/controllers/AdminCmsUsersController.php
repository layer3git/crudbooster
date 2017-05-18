<?php namespace App\Http\Controllers;

use Session;
use Request;
use DB;
use CRUDbooster;

class AdminCmsUsersController extends \crocodicstudio\crudbooster\controllers\CBController {


	public function cbInit() {
		# START CONFIGURATION DO NOT REMOVE THIS LINE
		$this->table               = 'cms_users';
		$this->primary_key         = 'id';
		$this->title_field         = "name";
		$this->button_action_style = "button_icon";
		$this->button_import       = TRUE;
		$this->button_export       = TRUE;
		$this->limit               = "20";
		$this->orderby             = "name,asc";
		$this->where               = "";
		$this->global_privilege    = FALSE;
		$this->button_table_action = TRUE;
		$this->button_bulk_action  = TRUE;
		$this->button_add          = TRUE;
		$this->button_edit         = TRUE;
		$this->button_delete       = TRUE;
		$this->button_detail       = TRUE;
		$this->button_show         = TRUE;
		$this->button_filter       = TRUE;
		# END CONFIGURATION DO NOT REMOVE THIS LINE

		# START COLUMNS DO NOT REMOVE THIS LINE
		$this->col = array();
		$this->col[] = array("label"=>"Name","name"=>"name");
		$this->col[] = array("label"=>"Email","name"=>"email");
		$this->col[] = array("label"=>"Privilege","name"=>"id_cms_privileges","join"=>"cms_privileges,name");
		$this->col[] = array("label"=>"Photo","name"=>"photo","image"=>TRUE);
		$this->col[] = array("label"=>"Custom Session Variables","name"=>"custom_session_variables");
		# END COLUMNS DO NOT REMOVE THIS LINE

		# START FORM DO NOT REMOVE THIS LINE
		$this->form = array();
		$this->form[] = array("label"=>"Name","name"=>"name","type"=>"text","validation"=>"required|alpha_spaces|min:3");
		$this->form[] = array("label"=>"Email","name"=>"email","type"=>"email","validation"=>"required|email|unique:cms_users,email,".CRUDBooster::getCurrentId());
		$this->form[] = array("label"=>"Photo","name"=>"photo","type"=>"upload","validation"=>"image|max:1000","help"=>"Recommended resolution is 200x200px");
		$this->form[] = array("label"=>"Privilege","name"=>"id_cms_privileges","type"=>"select","datatable"=>"cms_privileges,name");
		$this->form[] = array("label"=>"Password","name"=>"password","type"=>"password","help"=>"Please leave empty if not change");
		$this->form[] = array("label"=>"Custom Session Variables","name"=>"custom_session_variables","type"=>"textarea","validation"=>"string|min:0|max:5000","help"=>"Please insert a list of 'key:string_value' one per line");
		# END FORM DO NOT REMOVE THIS LINE

	}

	public function getProfile() {			

		$this->button_addmore = FALSE;
		$this->button_cancel  = FALSE;
		$this->button_show    = FALSE;			
		$this->button_add     = FALSE;
		$this->button_delete  = FALSE;	
		$this->hide_form 	  = ['id_cms_privileges'];

		$data['page_title'] = trans("crudbooster.label_button_profile");
		$data['row']        = CRUDBooster::first('cms_users',CRUDBooster::myId());		
		$this->cbView('crudbooster::default.form',$data);				
	}
}
