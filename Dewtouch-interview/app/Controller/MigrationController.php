<?php

use Shuchkin\SimpleXLSX;

require __DIR__.'/../Lib/SimpleXLSX.php';
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
            $xlsx = SimpleXLSX::parse(__DIR__.'/../webroot/files/migration_sample_1.xlsx');

            $this->loadModel('Member');
            $this->loadModel('Transaction');
            $this->loadModel('TransactionItem');
            $rows = $xlsx->rows();
            for ($i = 2; $i < sizeof($rows); $i++)
            {
                $row = $rows[$i];
                list($memberType,$memberId) = explode(' ',$row[3]);
                $memberRow = [
                    'type' => $memberType,
                    'no' => $memberId,
                    'name' => $row[2],
                    'created' => $row[0],
                    'valid' => 1

                ];
                $this->Member->create();
                $memberDb = $this->Member->save($memberRow);
                $memberId = $memberDb['Member']['id'];

                $this->Transaction->create();
                $transactionDb = $this->Transaction->save([
                    'member_id' => $memberId,
                    'member_name' => $row[2],
                    'member_paytype' => $row[4],
                    'date' => $row[0],
                    'year'=> $row[11],
                    'ref' => $row[1],
                    'receipt_no' => $row[8],
                    'payment_method' => $row[6],
                    'batch_no' => $row[7],
                    'cheque_no' => $row[9],
                    'payment_type' => null,
                    'renewal_year' => $row[11],
                    'subtotal' => $row[12],
                    'tax' => $row[13],
                    'total' =>$row[14]

                ]);
                $transactionId = $transactionDb['Transaction']['id'];
                $this->TransactionItem->create();
                $transactionItem = $this->TransactionItem->save([
                    'member_id' => $memberId,
                    'member_name' => $row[2],
                    'transaction_id' => $transactionId,
                    'description' => 'Being for Payment: '.$row[10],
                    'quantity' => 1,
                    'unit_price' =>$row[12],
                    'sum' => $row[14],
                    'created' =>$row[0],
                    'table' => 'Member',
                    'table_id' => $memberId,

                ]);
            }
        }
		
	}

    /**
     *   array(15) {
    [0]=>
    string(4) "Date"
    [1]=>
    string(7) "Ref No."
    [2]=>
    string(11) "Member Name"
    [3]=>
    string(9) "Member No"
    [4]=>
    string(15) "Member Pay Type"
    [5]=>
    string(14) "Member Company"
    [6]=>
    string(10) "Payment By"
    [7]=>
    string(8) "Batch No"
    [8]=>
    string(10) "Receipt No"
    [9]=>
    string(9) "Cheque No"
    [10]=>
    string(19) "Payment Description"
    [11]=>
    string(12) "Renewal Year"
    [12]=>
    string(8) "subtotal"
    [13]=>
    string(8) "totaltax"
    [14]=>
    string(5) "total"
    }
     */