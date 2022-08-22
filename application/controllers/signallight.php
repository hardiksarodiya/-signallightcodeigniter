<?php

	class Signallight extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
		}
		
		function index()
		{
            $this->load->helper("url", "form");
            $this->load->view("signallight");
		}
		
		function update()
		{
            $this->load->helper("url");
            $this->load->library('form_validation');
            
            if($this->input->get("type") == "getdata")
            {
                $this->load->database();        
                $this->load->model('signallight_model');
                $data = $this->signallight_model->getData(); 
                if(empty($data))
                {
                    echo json_encode(["status" => "error", "message" => "No Data Fount.", "data" => []]);
                    exit;
                }
                
                $signalvalue   = explode(",", $data->signalvalue);
                $signalordor = explode(",", $data->signalordor);
                
                echo json_encode(["status" => "ok", "message" => "Data Found", "data" => ["signalvalue" => $signalvalue, "signalordor" => $signalordor, "max_sequence" => count($signalordor), "signalgreenlight" => (int) $data->signalgreenlight, "signalyellowlight" => (int) $data->signalyellowlight]]);
                exit;
            }
            else if($this->input->get("type") == "setdata")
            {
                $data = $this->input->post(); 
                
                $signal      = $data['signal'];
                $greenlight  = $data['greenlight'];
                $yellowlight = $data['yellowlight'];
            
                $this->load->library('form_validation');
                $this->form_validation->set_rules('greenlight', 'Greenlight', 'required|numeric|greater_than[0]|regex_match[/^[0-9,]+$/]');  
                $this->form_validation->set_rules('yellowlight', 'Yellowlight', 'required|numeric|greater_than[0]|regex_match[/^[0-9,]+$/]');
                $this->form_validation->set_rules('signal[]', 'Signalsequence', 'required|numeric|greater_than[0]|regex_match[/^[0-9,]+$/]');                
                
                $this->form_validation->run();
                
                $errors = form_error('greenlight'); 
                if($errors != "")
                {
                    echo json_encode(["status" => "error", "message" => "Invalid Green Light Interval Value.", "data" => []]);
                    exit;
                }
                
                $errors = form_error('yellowlight'); 
                if($errors != "")
                {
                    echo json_encode(["status" => "error", "message" => "Invalid Yellow Light Interval Value.", "data" => []]);
                    exit;
                }
                
                $errors = form_error('signal[]'); 
                if($errors != "")
                {
                    echo json_encode(["status" => "error", "message" => "Invalid Interval Sequence Value.", "data" => []]);
                    exit;
                }
                if(!empty(array_diff_assoc($signal, array_unique($signal))))
                {
                    echo json_encode(["status" => "error", "message" => "Invalid Interval Sequence Value.", "data" => []]);
                    exit;
                }
                $falg = false;
                $tempvalue = [];
                $newsignal = [];
                $signal_flip = array_flip($signal);
                    
                for($i = 1;$i<=count($signal); $i++)
                {
                    $newsignal[] = array_search($i, array_keys($signal_flip)) + 1;

                    $tempvalue[] = $i;
                    if(!in_array($i, $signal))
                    {
                        $falg = true;
                    }
                }
                
                if($falg)
                {
                    echo json_encode(["status" => "error", "message" => "Allowed values in sequence are ".implode(",", $tempvalue), "data" => []]);
                    exit;
                }
                
                $data = array(
                    'signalvalue'=> implode(",", $signal),
                    'signalordor'=> implode(",", $newsignal),
                    'signalid' => '1',
                    'signalgreenlight' => $greenlight,
                    'signalyellowlight' => $yellowlight
                    );
                    
                $this->load->database();        
                $this->load->model('signallight_model');
                $data = $this->signallight_model->updateData($data);
            } 
            else
            {
                redirect('/signallight/index', 'refresh');
            }
		}
	}

?>
