<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Data_surat extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Data_surat_model');
    } 

    /*
     * Listing of data_surat
     */
    function index()
    {
        $data['data_surat'] = $this->Data_surat_model->get_all_data_surat();
        
        $data['_view'] = 'data_surat/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new data_surat
     */
    function add()
    {   
        if(isset($_POST) && count($_POST) > 0)     
        {   
            $params = array(
				'jenis' => $this->input->post('jenis'),
				'keterangan' => $this->input->post('keterangan'),
            );
            
            $data_surat_id = $this->Data_surat_model->add_data_surat($params);
            redirect('data_surat/index');
        }
        else
        {            
            $data['_view'] = 'data_surat/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a data_surat
     */
    function edit($id_surat)
    {   
        // check if the data_surat exists before trying to edit it
        $data['data_surat'] = $this->Data_surat_model->get_data_surat($id_surat);
        
        if(isset($data['data_surat']['id_surat']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					'jenis' => $this->input->post('jenis'),
					'keterangan' => $this->input->post('keterangan'),
                );

                $this->Data_surat_model->update_data_surat($id_surat,$params);            
                redirect('data_surat/index');
            }
            else
            {
                $data['_view'] = 'data_surat/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The data_surat you are trying to edit does not exist.');
    } 

    /*
     * Deleting data_surat
     */
    function remove($id_surat)
    {
        $data_surat = $this->Data_surat_model->get_data_surat($id_surat);

        // check if the data_surat exists before trying to delete it
        if(isset($data_surat['id_surat']))
        {
            $this->Data_surat_model->delete_data_surat($id_surat);
            redirect('data_surat/index');
        }
        else
            show_error('The data_surat you are trying to delete does not exist.');
    }
    
}