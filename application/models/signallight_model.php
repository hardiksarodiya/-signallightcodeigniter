<?php
class Signallight_model extends CI_Model 
{
	function getData()
	{
		$query = $this->db->get("signaldata");
		if(empty($query))
		{
            return [];
		}		

		return $query->result()[0];
	}
	
	function updateData($data)
	{
        extract($data);
        $this->db->where('signalid', $signalid);
        $status = $this->db->update('signaldata', array('signalvalue' => $signalvalue, 'signalordor' => $signalordor, 'signalgreenlight' => $signalgreenlight, 'signalyellowlight' => $signalyellowlight));
        print_r($status);
        exit;
        return true;
	}
	
} 
