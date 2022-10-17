<?php
require __DIR__.'/MSXLX.php';
	class MigrationController extends AppController{
		
		public function q1(){

			
// 			$this->set('title',__('Question: Please change Pop Up to mouse over (soft click)'));
		}
		
		public function q1_instruction(){

			$this->setFlash('Question: Migration of data to multiple DB table');


			
// 			$this->set('title',__('Question: Please change Pop Up to mouse over (soft click)'));
		}
        public function import()
        {

            $this->setFlash('Question: Migration of data to multiple DB table');
            $excel = new MSXLS(__DIR__.'/../webroot/files/migration_sample_1.xlsx');
            $excelData = $excel->read_everything();
            var_dump($excel->cells);
        }
		
	}