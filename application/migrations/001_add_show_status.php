<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Show_Status extends CI_Migration {
	public function up() {
		$this->dbforge->add_column('email', array(
			'show_status' => array(
				'type' => 'BOOL',
				'default' => '1',
				),
			));

		$fields = array(
                        'id' => array(
                                                 'type' => 'INT',
                                                 'constraint' => '11',
                                                 'auto_increment' => TRUE
                                          ),
                        'title' => array(
                                                 'type' => 'VARCHAR',
                                                 'constraint' => '100',
                                          ),
                        'filename' => array(
                                                 'type' =>'VARCHAR',
                                                 'constraint' => '100',
                                          ),
                        'ext' => array(
                                                 'type' => 'VARCHAR',
                                                 'constraint' => '100',
                                                 'null' => TRUE,
                                          ),
                );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('video_uploads', TRUE);
		// = CREATE TABLE IF NOT EXISTS table_name
		
	}
	public function down() {
		$this->dbforge->drop_column('email', 'show_status');
		$this->dbforge->drop_table('vidoes');
// = DROP TABLE IF EXISTS table_name
	}
}