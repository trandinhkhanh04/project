<?php
class productModel extends CI_Model
{

    public function insertProduct($data)
    {
        $this->db->trans_start();
        $this->db->insert('product', $data);
        if ($this->db->affected_rows() == 0) {
            $this->db->trans_rollback();
            return false;
        }
        $this->db->trans_complete();
        return true;
    }

    public function selectAllProduct()
    {
        $query = $this->db->select('categories.title as tendanhmuc, product.*, warehouses.*, brands.title as tenthuonghieu')
            ->from('categories')
            ->join('product', 'product.category_id = categories.id')
            ->join('warehouses', 'product.id = warehouses.product_id')
            ->join('brands', 'brands.id = product.brand_id')
            ->get();
        return $query->result();
    }
    public function selectProductById($ProductID)
    {
        $this->db->select('product.*');
        $this->db->from('product');
        $this->db->where('product.ProductID', $ProductID);
        $query = $this->db->get();
        return $query->row();
    }




    public function updateProduct($ProductID, $data)
    {
        return $this->db->update('product', $data, ['ProductID' => $ProductID]);
    }


    public function bulkUpdateStatus($product_ids, $new_status)
    {
        foreach ($product_ids as $product_id) {
            $this->db->update('product', ['Status' => $new_status], ['ProductID' => $product_id]);
        }
    }

    public function bulkUpdatePromotion($product_ids, $promotion)
    {
        foreach ($product_ids as $product_id) {
            $this->db->update('product', ['Promotion' => $promotion], ['ProductID' => $product_id]);
        }
    }





    public function getOrdersByProductId($product_id)
    {
        $this->db->select('order_code');
        $this->db->from('orders_details');
        $this->db->where('product_id', $product_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array(); // Trả về danh sách các order_code
        }
        return [];
    }



    public function getProductsByDisease($disease_name)
    {
        // Tìm sản phẩm liên quan đến tên bệnh
        // $this->db->like('description', $disease_name);
        $this->db->like('description', $disease_name);
        $this->db->where('status', 1);
        $query = $this->db->get('product');

        return $query->result();
    }



    public function getProductsPagination($limit, $start)
    {
        $this->db->limit($limit, $start);
        $query = $this->db->get_where('product', ['status' => 1]);
        return $query->result();
    }




    public function countAllProduct()
    {
        return $this->db->where(['status' => 1])->count_all_results('product');
    }

//     //tk ảnh
//     public function get_products_by_ids($ids = []) {
//     if (empty($ids)) return [];

//     // Ép tất cả ID về số nguyên để chắc chắn khớp với kiểu BIGINT
//     $ids = array_map('intval', $ids);

//     $this->db->where_in('ProductID', $ids);
//     $query = $this->db->get('product');
//     return $query->result_array();
// }
  

}
