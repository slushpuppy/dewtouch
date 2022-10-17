<?php
	class RecordController extends AppController{
		
		public function index(){
			ini_set('memory_limit','256M');
			set_time_limit(0);
			
			$this->setFlash('Listing Record page too slow, try to optimize it.');
			
			
			//$records = $this->Record->find('all');
			
			//$this->set('records',$records);
			
			
			$this->set('title',__('List Record'));
		}
        protected function getRecords($dbSet)
        {
            $rows = [];
            $filteredResultCount = count($dbSet);
            for($i = 0; $i < $filteredResultCount; $i++)
            {
                $row = $dbSet[$i]['Record'];
                $rows[] = [
                    $row["id"],
                    $row["name"]
                ];
            }
            return $rows;
        }


        public function ajax() {
            $this->response->type('application/json');
            $this->autoRender = false;
            $getParam = $this->request->query;
            $sqlFilter = [];
            $limit = 10;
            $page = 0;
            if ( isset( $getParam['iDisplayStart'] ) && $getParam['iDisplayLength'] != '-1' )
            {
                $page = intval( $getParam['iDisplayStart'] );
                $limit = intval( $getParam['iDisplayLength'] );
            }

            $recordsLen = $this->Record->find('count');

            $aColumns = [
                'id',
                'name'
            ];

            $draw = null;

            /*
             * Ordering
             */
            $sOrder = "";
            if ( isset( $_GET['iSortCol_0'] ) )
            {
                $sOrder = "";
                for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
                {
                    if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
                    {
                        $sOrder .= "`".$aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."` ".
                            ($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
                    }
                }

                $sOrder = substr_replace( $sOrder, "", -2 );
                if ( $sOrder !== "" )
                {
                    $sqlFilter['order'] = $sOrder;
                }

            }



            $output = [
                "draw" => $getParam['sEcho'],
                "aaData" => [],
                "iTotalRecords" => $recordsLen,
            ];

            if (strlen($getParam['sSearch']) > 0)
            {
                $sqlFilter['conditions'] =   [
                    'name LIKE' => '%'.$getParam['sSearch'].'%'
                ];

                $filteredResultLen = $this->Record->find('count',
                    $sqlFilter);
                $sqlFilter['limit'] = $limit;
                $sqlFilter['offset'] = $page;
                $filteredResult = $this->Record->find('all',
                    $sqlFilter);
                //var_dump($filteredResult);
                $output['aaData'] = $this->getRecords($filteredResult);

                $output["iTotalDisplayRecords"] = $filteredResultLen;
            }
            else
            {
                $sqlFilter['limit'] = $limit;
                $sqlFilter['offset'] = $page;
                $filteredResult = $this->Record->find('all',
                    $sqlFilter);
                $output['aaData'] = $this->getRecords($filteredResult);
                $output["iTotalDisplayRecords"] = $recordsLen;
            }



            echo json_encode($output);
        }
		
// 		public function update(){
// 			ini_set('memory_limit','256M');
			
// 			$records = array();
// 			for($i=1; $i<= 1000; $i++){
// 				$record = array(
// 					'Record'=>array(
// 						'name'=>"Record $i"
// 					)			
// 				);
				
// 				for($j=1;$j<=rand(4,8);$j++){
// 					@$record['RecordItem'][] = array(
// 						'name'=>"Record Item $j"		
// 					);
// 				}
				
// 				$this->Record->saveAssociated($record);
// 			}
			
			
			
// 		}
	}