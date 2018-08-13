<?php

use yii\db\Migration;

/**
 * Handles the creation of table `news`.
 */
class m180606_143718_create_user_tableMainTable extends Migration
{
    /** 
     * {@inheritdoc}
     */
    public function safeUp()
    {    $tableOptions = null;
	
	
	
	
	
	
			$this->createTable('{{%session}}', [
				'id' => $this->char(64)->notNull(),
				'expire' => $this->integer(),
				'data' => $this->binary()
			]);
			$this->addPrimaryKey('pk-id', '{{%session}}', 'id');
	
		
			 $this->createTable('order', [
            
			'id' => $this->primaryKey(),
			'userid'=> $this->integer(),
			'usersessition'=> $this->string(),
			'summ'=> $this->string(),
			'datatime'=> $this->dateTime(),
			'datatimeuploade'=> $this->dateTime(),
			'status'=> $this->integer(),
			'dуlivery'=> $this->integer(),
			'payment'=> $this->integer(),
			
			'md5'=> $this->string(),
			
			
			'name'=> $this->string(),
			'email' => $this->string(),
			'phone' => $this->string(),
			'adress'=> $this->string(),
			'comment'=> $this->string(),
			
			'index'=> $this->string(),
			]);

		
		
		
	
         $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
			'phone' => $this->string(),
			'adress' => $this->string(),
			'name' => $this->string(),
			
        ], $tableOptions);
		
		
		
			 $this->createTable('image', [
            'id' => $this->primaryKey(),
			'type'=>$this->integer(),
			'elementid'=> $this->integer(),			 
			'filed'=> $this->string(),
			'filep'=> $this->string(),
			'index1'=>$this->integer(),
			'index2'=>$this->string(),
			]);
		
		
		  $this->createTable('section', [
           'id' => $this->primaryKey(),
			'name'=> $this->string(),
			'code'=> $this->string(),
			'xmlcode'=> $this->string(),
			'xmlcodep'=> $this->string(),
			'active'=> $this->boolean(),
			'codep' => $this->string(),
			'idp' => $this->integer(),
			 
			'issection' => $this->boolean(),
			'index1' => $this->integer(),
			'index2' => $this->string(),
			'active' => $this->boolean(),
			
			
        ]);
		
		
		  $this->createTable('element', [
            'id' => $this->primaryKey(),
			'xmlcodep'=> $this->string(),
			'name'=> $this->string(),
				'artikul'=> $this->string(),
			'code'=> $this->string(),
			'xmlcode'=> $this->string(),
			'active'=> $this->boolean(),
			'codep' => $this->string(),
			'idp' => $this->integer(),
			'quantity' => $this->float(),
			'issection' => $this->boolean(),
			'index1' => $this->integer(),
					'indexp' => $this->integer(),
			'index2' => $this->string(),
			'active' => $this->boolean(),
			
        ]);
		
		
		 $this->createTable('price', [
            'id' => $this->primaryKey(),
			'type'=>$this->integer(),
			'elementid'=> $this->integer(),			 
			'price'=> $this->string(),
			'index1'=>$this->integer(),
			]);
		
		 
		
		
		
		 $this->createTable('quantity', [
            'id' => $this->primaryKey(),
			'type'=>$this->integer(),
			'elementid'=> $this->integer(),			 
			'quantity'=> $this->float(),
			'index1'=>$this->integer(),
			]);
		
		
		
		
		  $this->createTable('basket', [
            
			'id' => $this->primaryKey(),
			'userid'=> $this->integer(),
			'sessionid'=> $this->string(),
			
			'elementid'=> $this->integer(),
			//'price'=> $this->integer(),
			'sum'=> $this->float(),
			'quantity'=> $this->float(),
			'zakazid'=> $this->string(),
			'order'=> $this->boolean(), 
			'price'=> $this->float(), 
			
			
        ]);
		
		
		
			  $this->createTable('zakaz', [
            
			'id' => $this->primaryKey(),
			'userid'=> $this->integer(),
			'usersessitionsid'=> $this->integer(),
			'summ'=> $this->string(),
			 
			 
			 
			
			
        ]);
		
		
		
		
		
				  $this->createTable('usersessitions', [
            
			'id' => $this->primaryKey(),
			'userid'=> $this->integer(),
			 'session'=> $this->string(),
			 
			
			
        ]);
		
		
		
		
			  $this->createTable('cache', [
            
			'id' =>$this->char(128)->notNull(),//'id' =>$this->char(128)->primaryKey()->notNull(), 
			'expire'=> $this->integer(11),
			 'data'=> $this->binary(429496729),
			 
			 
			
        ]);
		
		
				// $this->alterColumn(
			   // 'cache',
				// 'id',
				// 'PRIMARY KEY'
				// );
		
		///'NOT NULL AUTO_INCREMENT PRIMARY KEY'
		
		
		
		Yii::$app->db->createCommand('ALTER TABLE cache  ADD PRIMARY KEY(id)')
       ->queryScalar();
		
		//this->execute("ALTER TABLE cache  ADD PRIMARY KEY(id)");
		
		
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
		 $this->dropTable('{{%session}}');
		 $this->dropTable('order');
		 $this->dropTable('image');
        $this->dropTable('user');
		 $this->dropTable('section');
		 $this->dropTable('element');		 
		 $this->dropTable('zakaz');
		 $this->dropTable('basket');
		 $this->dropTable('cache');
		 $this->dropTable('price');
		 $this->dropTable('usersessitions');
		 $this->dropTable('quantity');
					  
				  
		 
    }
}
