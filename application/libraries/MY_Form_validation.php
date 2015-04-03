<?php

class MY_Form_validation extends CI_Form_validation {

    function edit_unique($value, $params)
    {
        $CI =& get_instance();
        $CI->load->database();

        $CI->form_validation->set_message('edit_unique', "Sorry, that %s is already being used.");

        list($table, $field, $current_id) = explode(".", $params);

        $query = $CI->db->select()->from($table)->where($field, $value)->limit(1)->get();

        if ($query->row() && $query->row()->id != $current_id)
        {
            return FALSE;
        }
    }

    function date_greater_than($value, $params)
    {
        $CI =& get_instance();
        $CI->form_validation->set_message('date_greater_than', " %s is must greater than ".$params." field");
        $lt_field = $params;
        if (isset($this->_field_data[$lt_field]))
        {
            try{
                $gt_date = strtotime($value);
                $lt_date = strtotime($this->_field_data[$lt_field]['postdata']);
                return $gt_date >= $lt_date;
            }catch(Exception $e)
            {
                $CI->form_validation->set_message('date_greater_than', " %s must be a date");
            }  
        }
        return false;
    }

}