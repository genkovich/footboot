<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_video_uploads extends CI_Migration {
	public function up() {
		

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
                                          ),
                        'size' => array(
                                                 'type' => 'FLOAT',
                                                 'constraint' => '15',
                                          ),
                );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('video_uploads', TRUE);
		// = CREATE TABLE IF NOT EXISTS table_name
		
	}
	public function down() {
		$this->dbforge->drop_table('video_uploads');
// = DROP TABLE IF EXISTS table_name
	}
}