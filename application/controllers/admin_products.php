<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_products extends CI_Controller {
 
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {

        parent::__construct();

        $this->load->model('products_model');

        $this->load->model('manufacturers_model');

        $this->load->model('categories_model');


        if(!$this->session->userdata('is_logged_in')){

            redirect('admin/login');

        }
        elseif ($this->session->userdata('roll') != 'admin'){

            redirect('member/profiles');

        }
    }
 
    /**
    * Load the main view with all the current model model's data.
    * @return void
    */
    public function index(){

        $data['main_content'] = 'admin/index';

        $this->load->view('includes/template', $data);

    }
    public function index_products()
    {

            $data['manufactures'] = $this->manufacturers_model->get_manufacturers();

            $data['categories'] = $this->categories_model->get_categories();

            $data['products'] = $this->products_model->get_products();
            //load the view

            $data['main_content'] = 'admin/products/list';

            $this->load->view('includes/template', $data);

    }//index

    public function add()
    {
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {

            //form validation
            $this->form_validation->set_rules('name', 'name', 'required|min_lenght(2)');

            $this->form_validation->set_rules('model', 'model', 'required|min_lenght(2)');

            $this->form_validation->set_rules('description', 'description', 'required');

            $this->form_validation->set_rules('stock', 'stock', 'required|numeric');

            $this->form_validation->set_rules('sell_price', 'sell_price', 'required|numeric');

            $this->form_validation->set_rules('brand', 'brand', 'required');

            $this->form_validation->set_rules('model', 'model', 'required');

            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $product_image = $this->uploadfile();

                $data_to_store = array(

                    'product_name' => $this->input->post('name'),

                    'product_category' => $this->input->post('model'),

                    'description' => $this->input->post('description'),

                    'stock' => $this->input->post('stock'),

                    'sell_price' => $this->input->post('sell_price'),

                    'manufacture_id' => $this->input->post('brand'),

                    'category_id' => $this->input->post('submodel'),

                    'image' => $product_image

                );
                //if the insert has returned true then we show the flash message
                if($this->products_model->store_product($data_to_store)){

                    $data['flash_message'] = TRUE;

                }else{

                    $data['flash_message'] = FALSE;

                }

            }

        }
        //fetch manufactures data to populate the select field
        $data['manufactures'] = $this->manufacturers_model->get_manufacturers();

        $data['categories'] = $this->categories_model->get_categories();

        //load the view
        $data['main_content'] = 'admin/products/add';

        $this->load->view('includes/template', $data);
    }


    function get_sub_category(){
        $manufacure_id = $this->input->post('id',TRUE);
        $data = $this->categories_model->get_categories($manufacure_id);
        echo json_encode($data);
    }


    public function uploadfile(){

        $config = [

            'upload_path' => './uploads/product/',

            'allowed_types' => 'gif|png|jpg|jpeg',

        ];

        $this->load->library('upload', $config);

        $this->form_validation->set_error_delimiters();

        $this->upload->do_upload('file');

        $info = $this->upload->data();

        $image_path = base_url("/uploads/product/". $info['raw_name'].$info['file_ext']);

        return $image_path;

        /*upload*/
    }

    /**
    * Update item by his id
    * @return void
    */
    public function update()
    {
        //product id 
        $id = $this->uri->segment(4);
  
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation

            $this->form_validation->set_rules('name', 'name', 'required|min_lenght(2)');

            $this->form_validation->set_rules('model', 'model', 'required|min_lenght(2)');

            $this->form_validation->set_rules('description', 'description', 'required');

            $this->form_validation->set_rules('stock', 'stock', 'required|numeric');

            $this->form_validation->set_rules('sell_price', 'sell_price', 'required|numeric');

            $this->form_validation->set_rules('brand', 'brand', 'required');

            $this->form_validation->set_rules('submodel', 'submodel', 'required');

            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(

                    'product_name' => $this->input->post('name'),

                    'product_category' => $this->input->post('model'),

                    'description' => $this->input->post('description'),

                    'stock' => $this->input->post('stock'),

                    'sell_price' => $this->input->post('sell_price'),

                    'manufacture_id' => $this->input->post('brand'),

                    'category_id' => $this->input->post('submodel')

                );
                //if the insert has returned true then we show the flash message
                if($this->products_model->update_product($id, $data_to_store) == TRUE){

                    $this->session->set_flashdata('flash_message', 'updated');

                }else{

                    $this->session->set_flashdata('flash_message', 'not_updated');

                }

                redirect('admin/products/update/'.$id.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //product data
        //this function need for edit page

        $data['product'] = $this->products_model->get_products('', '', $id);
        //fetch manufactures data to populate the select field

        $data['manufactures'] = $this->manufacturers_model->get_manufacturers();

        $data['categories'] = $this->categories_model->get_categories();
        //load the view

        $data['main_content'] = 'admin/products/edit';

        $this->load->view('includes/template', $data);

    }//update

    /**
    * Delete product by his id
    * @return void
    */
    public function delete()
    {
        //product id
        $id = $this->uri->segment(4);


        $this->products_model->delete_product($id);

        redirect('admin/products');

    }//edit

}