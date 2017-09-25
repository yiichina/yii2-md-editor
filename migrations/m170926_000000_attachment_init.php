<?php

use yii\db\Migration;

class m170926_000000_attachment_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        // Attachment
        $this->createTable('{{%attachment}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'filename' => $this->string()->notNull(),
            'size' => $this->integer()->notNull(),
            'type' => $this->string()->notNull(),
            'downloads' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'is_file' => $this->smallInteger()->notNull()->defaultValue(0),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%attachment}}');
    }
}
