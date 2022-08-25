<?php
class Uploads
{
	// hanya bisa di akses oleh class ini
	private $file, $tujuan, $jenis, $custome;

	// dapat diakses bebas
	public $nama, $ext, $type, $hasil, $size, $status, $upfile;
	//private hanya bisa di akses class dan turunan

	public function __CONSTRUCT( $file, $tujuan, $jenis = "all", $custome = "off" )
	{
		$this->file = $file;
		$this->tujuan = $tujuan;
		$this->jenis = $jenis;
		$this->custome = $custome;
	}

	public function single()
	{
		// print_r($this->file);
		$this->nama = $this->ade($this->file['name']);
		$this->ext = pathinfo($this->nama, PATHINFO_EXTENSION);
		$this->type = $this->file['type'];
		$this->size = $this->file['size'];

		$this->upload($this->file['tmp_name']);

		return $this->hasil = [
			"nama" => $this->nama,
			"ext" => $this->ext,
			"type" => $this->type,
			"size" => $this->ukuran(),
			"status" => $this->status,
			"file" => $this->upfile,
		];
	}

	public function multi()
	{
		$sum = count($this->file['name']);

		for ($i=0; $i < $sum; $i++) {
			$this->nama = $this->ade($this->file['name'][$i]);
			$this->ext = pathinfo($this->nama, PATHINFO_EXTENSION);
			$this->type = $this->file['type'][$i];
			$this->size = $this->file['size'][$i];

			$this->upload($this->file['tmp_name'][$i]);

			$result[] = [
				"nama" => $this->nama,
				"ext" => $this->ext,
				"type" => $this->type,
				"size" => $this->ukuran(),
				"status" => $this->status,
				"file" => $this->upfile,
			];
		}
		return $this->hasil = $result;
	}

	public function ade($data)
	{
		$data = strtolower($data);
		$data = str_replace(" ", "-", $data);
		return $data;
	}

	function ukuran()
	{
		$data = $this->size;
		$satuan = ["B", "KB", "MB", "GB", "TB", "PB"];
		$awal = 0;

		while ($awal < count($satuan) )
		{
			if($data < 1024)
			{
				return ( round( $data, 2 ) . " ". $satuan[$awal] );
			}
			$data /= 1024;
			$awal++;
		}

		// for ($i=0; ($data >= 1024 && $i < (count($satuan) -1) ; $i++) {
		// 	$data /= 1024;
		// 	return (round($data, 2) . " ". $satuan[$i]);
		// }
	}

	public function upload($data)
	{
		$nama_file = [
			"off" => rand(). ".". $this->ext ,
			"name" => rtrim( $this->nama, ".". $this->ext). ".". $this->ext ,
			"date" => date("Y-m-d-H-i-s-"). rand(0,99). ".". $this->ext ,
		];

		$this->upfile = $nama_file[$this->custome];

		if( move_uploaded_file( $data, $this->tujuan. $this->upfile ) )
		{
			$this->status = "Success";
		} else { $this->status = "Failed"; }
	}
}