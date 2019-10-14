<?php


class Member_product_model extends CI_Model
{

    public function get_products($manufacture_id = null, $category_id = null, $search_string = null,  $limit_start = null, $limit_end = null)
    {

        $this->db->select('products.id, products.description, products.stock, products.sell_price, products.manufacture_id, products.image, manufacturers.name as manufacture_name, categories.name as category_name, products.product_name as product_name, products.product_category as product_category');
        $this->db->from('products');
        if ($manufacture_id != null && $manufacture_id != 0 && $category_id != null && $category_id != 0) {
            $this->db->where('manufacture_id', $manufacture_id);
            $this->db->where('category_id', $category_id);
        }
        if ($search_string) {
            $this->db->like('description', $search_string);
        }

        $this->db->join('manufacturers', 'products.manufacture_id = manufacturers.id', 'left');
        $this->db->join('categories', 'products.category_id = categories.id', 'left');

        $this->db->group_by('products.id');

        if (!empty($limit_start) && !empty($limit_end)){
            $this->db->limit($limit_start, $limit_end);
        }

        $query = $this->db->get();

        return $query->result_array();
    }

    public function buy_product($data){
        $product_id = (int)$data['product_id'];
        $row_count = $this->show_products(null, $product_id, 'row');
        if (isset($row_count[0]['product_id']) && $row_count > 1){
            $upd = [
                'count' => $data['count'] + $row_count[0]['count']
            ];
            $this->db->where('product_id', $data['product_id']);
            $this->db->update('buy_product', $upd);
        }
        else{
            $this->db->insert('buy_product', $data);
        }
    }
    public function show_products($user_id = null, $product_id = null, $result = null, $status = null){


        $this->db->select('products.id, products.product_name, products.product_category , products.description, products.sell_price,  products.stock, buy_product.product_id, buy_product.user_id, buy_product.count, buy_product.status, users.id');
        //if $row  = row return table row with id product so when call this function need set product id
        if ($result == 'row' && !is_null($product_id)){
            $this->db->select('count(*) as count_row');
        }

        $this->db->from('buy_product');

        $this->db->join('users','users.id = buy_product.user_id', 'left');

        $this->db->join('products','products.id = buy_product.product_id', 'left');

        if (!is_null($user_id)){
            $this->db->where('users.id', $user_id);
        }

        if (!is_null($product_id)){
            $this->db->where('buy_product.product_id', $product_id);
        }
        if (!is_null($status) && $status = 1){
            $this->db->where('buy_product.status', $status);
        }

        $query = $this->db->get();

        return $query->result_array();

    }



    public function buy_this_product($id,$userId, $stock){
        $this->load->helper('cookie');
        $product_info = $this->show_products($userId, $id, null, null);

        $stock_count = $product_info[0]['stock'];
        if ($stock_count <= '0'){
            return false;
        }
        else{
            $this->db->set('stock', "$stock_count - $stock" , FALSE);
            $this->db->where('id', $id);
            $this->db->update('products');
            $this->db->where('product_id', $id);
            $this->db->set('status', 1);
            $this->db->update('buy_product');
            $this->load->helper('cookie');
            $history = $this->show_products($userId, null,null,1);
            $his = array(
                'history' => $history
            );
            $this->session->sess_expiration = '100';
            $this->session->sess_expire_on_close = 'true';
            $this->session->set_userdata($his);
            return true;
        }

    }

    public function delete($id){
        $this->db->where('product_id', $id);
        $this->db->delete('buy_product');
    }

}