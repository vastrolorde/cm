<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rental_model extends CI_Model {

	public function getAll(){
		$this->db->select('rental.id, rental.desc, rental.start_contract, rental.expire_contract, pt.partner_name');
		$this->db->select("DATE_FORMAT(start_contract,'%d/%m/%Y') as start");
		$this->db->select("DATE_FORMAT(expire_contract,'%d/%m/%Y') as exp");
		$this->db->where('active','Y');
		$this->db->from('rental');
		$this->db->join('partner as pt', 'pt.id = rental.partner_id','right');
		$query = $this->db->get();
		return $result = $query->result();
	}



	public function get($id){
		$this->db->select('rental.id, rental.partner_id, rental.desc, rental.create_date, rental.ref_doc, rental.start_contract, rental.expire_contract, rental.duration, rental.paymentType, rental.guaranteeType, rental.tranferDate,rental.Acc_no , rental.tranferNote, rental.Bank, rental.branch, rental.daily_rental, rental.total_rental, rental.total_guarantee, rental.discount, rental.VATType, rental.VAT, rental.grandtotal, rental.active ');
		$this->db->select('pt.partner_name, pt.tel, pt.email');
		$this->db->select('bank.name as bankname');
		$this->db->select("DATE_FORMAT(rental.start_contract, '%d/%m/%Y') as start");
		$this->db->select("DATE_FORMAT(rental.expire_contract, '%d/%m/%Y') as exp");
		$this->db->select("DATE_FORMAT(rental.tranferDate, '%d/%m/%Y') as trDate");
		$this->db->where('rental.id', $id);
		$this->db->from('rental');
		$this->db->join('partner as pt', 'pt.id = rental.partner_id','right');
		$this->db->join('bank as bank', 'bank.id = rental.Bank','right');
		$query = $this->db->get();
		return $result = $query->result();
	}

	public function create($data){
		$this->db->insert('rental',$data);
	}

	public function update($id,$data){
		$this->db->where('id',$id);
		$this->db->update('rental',$data);
	}

	public function delete($id){
		$this->db->set('active','N');
		$this->db->where('id',$id);
		$this->db->update('rental');
	}

	//Inventory Movement
	public function qry_tr($data){
		$this->db->select("tr.id, tr.rental_id, tr.product_id, tr.amount");
		$this->db->select("pro.product_id, pro.product_name, pro.product_d_RentalPrice, pro.product_GuaranteePrice, pro.product_weight");
		$this->db->where('rental_id',$data);
		$this->db->from('rental_tr as tr');
		$this->db->join('product as pro','tr.product_id = pro.product_id');
		$query = $this->db->get();
		return $result = $query->result();
	}

	public function add_tr($data){
		$this->db->insert('rental_tr',$data);
	}
	
	public function update_tr($id,$data){
		$this->db->where('id',$id);
		$this->db->update('rental_tr',$data);
	}

	public function del_tr($id){
		$this->db->where('id',$id);
		$this->db->delete('rental_tr');
	}
}
