<?php

class MY_Form_validation extends CI_Form_validation {

    function edit_unique($value, $params)
    {
        $this->CI->load->database();

        $this->CI->form_validation->set_message('edit_unique', "Sorry, that %s is already being used.");

        list($table, $field, $current_id) = explode(".", $params);

        $query = $this->CI->db->select()->from($table)->where($field, $value)->limit(1)->get();

        if ($query->row() && $query->row()->id != $current_id)
        {
            return FALSE;
        }
    }

    function date_greater_than($value, $params)
    {
        $lt_field = $params;
        if (isset($this->_field_data[$lt_field]))
        {
            try{
                $gt_date = strtotime($value);
                $lt_date = strtotime($this->_field_data[$lt_field]['postdata']);
                if ($gt_date >= $lt_date){return true;}
            }catch(Exception $e)
            {}
        }
        $this->CI->form_validation->set_message('date_greater_than', " %s is must greater than ".$params." field");
        return false;
    }

    function time24($value, $params)
    {
        if (preg_match('/(2[0-3]|[0-1]?[0-9]):[0-5]?[0-9](:[0-5]?[0-9])?/', $value))
        {
          return true;
        }
        $this->CI->form_validation->set_message('time24', " %s must be 24 hour format");
        return false;
    }

    function time_greater_than($value, $params)
    {
        $lt_time = $params;
        if (array_key_exists($lt_time, $this->_field_data))
        {
            try{
                $gt_time = carbon_format($value, $format='H:i');
                $lt_time = carbon_format($this->_field_data[$lt_time]['postdata'], $format='H:i');
                if ($gt_time > $lt_time){return true;}
            }catch(Exception $e){}
        }
        $this->CI->form_validation->set_message('time_greater_than', " %s is must greater than ".$params." field");
        return false;
    }

}