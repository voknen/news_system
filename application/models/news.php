<?php

class News extends CI_Model {

    public function select($params = array())
    {
        $id = isset($params['id']) ? $params['id'] : '';
        $limit = isset($params['limit']) ? $params['limit'] : '';
        $status = isset($params['status']) ? $params['status'] : '';

        $this->db->select('
            id,
            title,
            text,
            date,
            thumbnail
        ');

        $this->db->from('news');

        if ($limit != '') {
            $this->db->limit($limit);
        }

        if ($status != '') {
            $this->db->where('status', $status);
        }

        if ($id != '') {
            $this->db->where('id', $id);
        }

        $this->db->order_by('date', 'desc');
        $query = $this->db->get();

        return $query->result();
    }

    public function insert($data)
    {
        $query = $this->db->insert('news', $data);
        return $query;
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('news', $data);

        return $this->db->affected_rows();
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('news');
    }
}