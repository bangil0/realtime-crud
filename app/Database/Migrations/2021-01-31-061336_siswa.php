<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Siswa extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'nisn' => [
				'type' => 'int',
				'constraint' => 255
			],
			'name' => [
				'type' => 'varchar',
				'constraint' => 255,
			],
			'address' => [
				'type' => 'varchar',
				'constraint' => 255
			],
		]);

		$this->forge->addKey('nisn',true);
		$this->forge->createTable('siswa');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('siswa');
	}
}
