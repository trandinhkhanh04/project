<?php
class ShipperModel extends CI_Model
{
        public function __construct()
    {
        parent::__construct();
    }
    public function getAll()
    {
        return $this->db->get('shippers')->result();
    }

    public function getById($id)
    {
        return $this->db->get_where('shippers', ['ShipperID' => $id])->row();
    }

    public function insert($data)
    {
        return $this->db->insert('shippers', $data);
    }


    public function update($id, $data)
    {
        $this->db->where('ShipperID', $id);
        return $this->db->update('shippers', $data);
    }

    public function delete($id)
    {
        $this->db->where('ShipperID', $id);
        return $this->db->delete('shippers');
    }

  public function getShippers($limit, $offset, $filter = [])
{
    if (!empty($filter['keyword'])) {
        $this->db->group_start(); // mở ngoặc ( )
        $this->db->like('Name', $filter['keyword']);
        $this->db->or_like('Phone', $filter['keyword']);
        $this->db->group_end();   // đóng ngoặc
    }

    if (isset($filter['status']) && $filter['status'] !== '') {
        $this->db->where('Status', $filter['status']);
    }

    return $this->db->get('shippers', $limit, $offset)->result();
}


public function countShippers($filter = [])
{
    if (!empty($filter['keyword'])) {
        $this->db->like('Name', $filter['keyword']);
    }
    if (isset($filter['status']) && $filter['status'] !== '') {
        $this->db->where('Status', $filter['status']);
    }

    return $this->db->count_all_results('shippers');
}

public function getByEmail($email)
{
    return $this->db->get_where('shippers', ['Email' => $email])->row();
}

public function getOrdersByShipper($shipper_id)
{
    if (empty($shipper_id)) return []; // Không có shipper, trả về rỗng

    $this->db->select('orders.*, users.Name as Customer_Name, users.Phone, users.Address, orders.TotalAmount');
    
    $this->db->from('orders');
    $this->db->join('users', 'orders.UserID = users.UserID');
    $this->db->where('orders.ShipperID IS NOT NULL'); // Chỉ lấy đơn đã gán shipper
    $this->db->where('orders.ShipperID', $shipper_id); // Và phải đúng shipper
    $query = $this->db->get();
    return $query->result();
}

public function getOrderByCode($order_code, $shipper_id)
{
    $this->db->select('o.*, u.Name as Customer_Name, u.Phone, u.Address');
    $this->db->from('orders o');
    $this->db->join('users u', 'u.UserID = o.UserID');
    $this->db->where('o.Order_Code', $order_code);
    $this->db->where('o.ShipperID', $shipper_id);
    $query = $this->db->get();
    return $query->row();
}

public function getOrdersByStatus($shipper_id, $status)
{
    $this->db->select('o.*, u.Name as Customer_Name, u.Phone, u.Address');
    $this->db->from('orders o');
    $this->db->join('users u', 'u.UserID = o.UserID');
    $this->db->where('o.ShipperID', $shipper_id);
    $this->db->where('o.Order_Status', $status);
    return $this->db->get()->result();
}

public function countOrdersByStatus($shipper_id, $status)
{
    $this->db->where('ShipperID', $shipper_id);
    $this->db->where('Order_Status', $status);
    return $this->db->count_all_results('orders');
}

public function getShipperById($id) {
    return $this->db->get_where('shippers', ['ShipperID' => $id])->row();
}

public function updateShipper($id, $data) {
    $this->db->where('ShipperID', $id);
    return $this->db->update('shippers', $data);
}


}
