<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Member_product extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('products_model');
        $this->load->model('manufacturers_model');
        $this->load->model('categories_model');
        $this->load->model('member_product_model');
        $this->load->model('products_model');
        $this->load->library('pagination');

    }

    /**
     * Load the main view with all the current model model's data.
     * @return void
     */
    public function index($page = 0)
    {

        //all the posts sent by the view

        $manufacture_id     =   $this->input->post('manufacture_id');

        $category_id        =   $this->input->post('category_id');

        $search_string      =   $this->input->post('search_string');

        $order              =   $this->input->post('order');

        $order_type         =   $this->input->post('order_type');

        //pagination settings

        $config['per_page']         =     6;

        $config['base_url']         =     base_url('member/product');

        $config['total_rows']       =     $this->db->get('products')->num_rows();

        $config['use_page_numbers'] =     TRUE;

        $config['num_links']        =     20;

        $config['records']          =     $this->db->select('*')->get('products', $config['per_page'],$page);

        $config['full_tag_open']    =    '<div class="pagging text-center ml-auto"><nav class="ml-auto"><ul class="pagination">';

        $config['full_tag_close']   =    '</ul></nav></div>';

        $config['num_tag_open']     =    '<li class="page-item"><span class="page-link">';

        $config['num_tag_close']    =    '</span></li>';

        $config['cur_tag_open']     =    '<li class="page-item active"><span class="page-link">';

        $config['cur_tag_close']    =    '<span class="sr-only">(current)</span></span></li>';

        $config['next_tag_open']    =    '<li class="page-item"><span class="page-link">';

        $config['next_tag_close']   =    '<span aria-hidden="true"></span></span></li>';

        $config['prev_tag_open']    =    '<li class="page-item"><span class="page-link">';

        $config['prev_tag_close']   =    '</span></li>';

        $config['first_tag_open']   =    '<li class="page-item"><span class="page-link">';

        $config['first_tag_close']  =    '</span></li>';

        $config['last_tag_open']    =    '<li class="page-item"><span class="page-link">';

        $config['last_tag_close']   =    '</span></li>';
        //limit end
        //math to get the initial record to be select in the database
        $limit_end = ($page * $config['per_page']) - $config['per_page'];

        if ($limit_end < 0){

            $limit_end = 0;

        }
        //if order type was changed

        if($order_type){

            $filter_session_data['order_type'] = $order_type;

        }

        else{
            //we have something stored in the session?

            if($this->session->userdata('order_type')){

                $order_type = $this->session->userdata('order_type');

            }else{
                //if we have nothing inside session, so it's the default "Asc"
                $order_type = 'Asc';

            }

        }
        //make the data type var avaible to our view
        $data['order_type_selected'] = $order_type;
        //we must avoid a page reload with the previous session data
        //if any filter post was sent, then it's the first time we load the content
        //in this case we clean the session filter data
        //if any filter post was sent but we are in some page, we must load the session data
        //filtered && || paginated
        if($manufacture_id !== false && $category_id !== false && $search_string !== false && $order !== false || $this->uri->segment(3) == true){

            /*
            The comments here are the same for line 79 until 99
            if post is not null, we store it in session data array
            if is null, we use the session data already stored
            we save order into the the var to load the view with the param already selected
            */
            if($manufacture_id !== 0){

                $filter_session_data['manufacture_selected'] = $manufacture_id;

            }else{

                $manufacture_id = $this->session->userdata('manufacture_selected');

            }

            $data['manufacture_selected'] = $manufacture_id;

            if($category_id !== 0){

                $filter_session_data['category_selected'] = $category_id;

            }else{

                $category_id = $this->session->userdata('category_selected');

            }

            $data['category_selected'] = $category_id;

            if($search_string){

                $filter_session_data['search_string_selected'] = $search_string;

            }else{

                $search_string = $this->session->userdata('search_string_selected');

            }

            $data['search_string_selected'] = $search_string;

            if($order){

                $filter_session_data['order'] = $order;

            }
            else{

                $order = $this->session->userdata('order');

            }

            $data['order'] = $order;
            //save session data into the session

            $this->session->set_userdata($filter_session_data);
            //fetch manufacturers data into arrays

            $data['manufactures'] = $this->manufacturers_model->get_manufacturers();

            $data['categories'] = $this->categories_model->get_categories();

            $data['count_products']= $this->products_model->count_products($manufacture_id, $category_id, $search_string, $order);

            $config['total_rows'] = $data['count_products'];
            //fetch sql data into arrays
            if($search_string){

                if($order){

                    $data['products'] = $this->products_model->get_products($manufacture_id,  $category_id, null, $search_string, $order, $order_type, $config['per_page'], $limit_end);

                }else{

                    $data['products'] = $this->products_model->get_products($manufacture_id,  $category_id, null, $search_string, null,   $order_type, $config['per_page'], $limit_end);

                }

            }else{

                if($order){

                    $data['products'] = $this->products_model->get_products($manufacture_id, $category_id, null,null,$order, $order_type, $config['per_page'],$limit_end);

                }else{

                    $data['products'] = $this->products_model->get_products($manufacture_id, $category_id,null, null,null, $order_type, $config['per_page'],$limit_end);

                }

            }
        }else{
            //clean filter data inside section

            $filter_session_data['manufacture_selected']    = null;

            $filter_session_data['category_selected']       = null;

            $filter_session_data['search_string_selected']  = null;

            $filter_session_data['order']                   = null;

            $filter_session_data['order_type']              = null;

            $this->session->set_userdata($filter_session_data);
            //pre selected options

            $data['search_string_selected']                 = '';

            $data['manufacture_selected']                   = 0;

            $data['category_selected']                      = 0;

            $data['order']                                  = 'id';
            //fetch sql data into arrays

            $data['manufactures']                           = $this->manufacturers_model->get_manufacturers();

            $data['categories']                             = $this->categories_model->get_categories();

            $data['count_products']                         = $this->products_model->count_products();

            $data['products']                               = $this->products_model->get_products(null,null, null, null,null, $order_type, $config['per_page'],$limit_end);

            $config['total_rows']                           = $data['count_products'];

        }
        //initializate the panination helper
        $this->pagination->initialize($config);
        //load the view
        $data['main_content'] = '/member/products/show/list';

        $this->load->view('includes/tamplate_user', $data);

    }
    function get_sub_category(){

        $manufacure_id = $this->input->post('id',TRUE);

        $data = $this->categories_model->get_categories($manufacure_id);

        echo json_encode($data);

    }


    //buy member product
    public function buy_product(){
        $user_id = $this->session->userdata('user_info');
        $product_id = $this->input->post('product_id');

        $selected_count = $this->input->post('count_of_product');
        $stock = $this->member_product_model->get_products();
        if (empty($selected_count)){

            $selected_count = 1;

        }
        if ($selected_count > $stock[0]["stock"]){
            $error_message = "<div class='alert alert-danger' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span></button>
                                <strong>OOOPS!</strong> count is so much!
                              </div>";
            $response = ['success' =>false,'message'=>$error_message];

            echo json_encode($response);exit();
        }
        else{
            $error_message = "<div class='alert alert-success' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span></button>
                                <strong>Congrats!</strong> you add this product in card!
                              </div>";
            $response = ['success'=>true,'message'=>$error_message];
            $data = [
                'user_id' => $user_id,
                'product_id' => $product_id,
                'count' => $selected_count
            ];
            $this->member_product_model->buy_product($data);
            echo json_encode($response);exit();
        }

    }

    public function show_products(){
        $list = $this->member_product_model->show_products();
        $data = [
            'list_products' => $list
        ];
        $data['main_content'] = 'member/products/show/product_list';
        $this->load->view('includes/tamplate_user', $data);
    }

    public function buy_this_product(){
        $user_id        = $this->session->userdata('user_info');
        $product_id     = $this->uri->segment(4);
        $product_count  = $this->uri->segment(5);
        $this->member_product_model->buy_this_product($product_id,$user_id, $product_count);
        redirect('member/products/list');

    }

    public function delete_bough_product(){
        $id = $this->uri->segment(4);
        $this->member_product_model->delete($id);
        redirect('member/products/list');

    }
}