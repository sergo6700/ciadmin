<?php
class Products_model extends CI_Model {
	protected $table = 'products';
	/**
	 * Store the new item into the database
	 * @param array $data - associative array with data to store
	 * @return boolean
	 */
	function store_product($data)
	{

		$insert = $this->db->insert('products', $data);

		return $insert;

	}
	//for pagination
	function count_products($manufacture_id=null, $category_id = null ,$search_string=null, $order=null)
	{

		$this->db->select('*');

		$this->db->from('products');

		if($manufacture_id != null && $manufacture_id != 0){

			$this->db->where('manufacture_id', $manufacture_id);

		}
		if($category_id != null && $category_id != 0){

			$this->db->where('category_id', $category_id);

		}
		if($search_string){

			$this->db->like('description', $search_string);

		}
		if($order){

			$this->db->order_by($order, 'Asc');

		}else{

			$this->db->order_by('id', 'Asc');

		}

		$query = $this->db->get();

		return $query->num_rows();

	}

    public function get_products($manufacture_id = null, $category_id = null, $id = null, $search_string=null, $order=null, $order_type='Asc', $limit_start = null, $limit_end = null)
    {

    	$this->db->select('products.id, products.description, products.stock,  products.sell_price, products.image, products.manufacture_id, products.category_id ,manufacturers.name as manufacture_name, categories.name as category_name , products.product_name as product_name, products.product_category as product_category');

    	$this->db->from('products');

    	if (!is_null($manufacture_id) && $manufacture_id !== 0){

			$this->db->where('products.manufacture_id', $manufacture_id);

    	}
    	if (!is_null($category_id) && $category_id !== 0){

			$this->db->where( 'products.category_id', $category_id);

		}

    	if(!is_null($id) && $id !== 0){

			$this->db->where('products.id', $id);
		}

    	if(!is_null($search_string)){

			$this->db->like('description', $search_string);

    	}

		$this->db->join('manufacturers', 'products.manufacture_id = manufacturers.id', 'left');

		$this->db->join('categories', 'products.category_id = categories.id', 'left');

		$this->db->group_by('products.id');

		if($order){

			$this->db->order_by($order, $order_type);

		}else{

			$this->db->order_by('id', $order_type);
		}

		if (!is_null($limit_start) && !is_null($limit_end)){

			$this->db->limit($limit_start, $limit_end);
			//$this->db->limit('4', '4');

		}

		$query = $this->db->get();

		if (!is_null($id)){

			return $query->result_array()[0];

		}
		else{

			return $query->result_array();

		}

    }


    /**
    * Update product
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_product($id, $data)
    {

    	$this->db->where('id', $id);

    	$this->db->update('products', $data);

    	$report = array();

    	$report['error'] = $this->db->_error_number();

    	$report['message'] = $this->db->_error_message();

    	if($report !== 0){

			return true;

    	}else{

			return false;

    	}
	}

    /**
    * Delete product
    * @param int $id - product id
    * @return boolean
    */
	function delete_product($id){
		//this query will be delete from products
		$this->db->where('id', $id);
		$this->db->delete('products');

	}
 
}
?>	
