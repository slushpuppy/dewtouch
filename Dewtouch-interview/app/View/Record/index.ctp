<div class="row-fluid">
	<table class="table table-bordered" id="table_records">
        <thead>
        <tr>
            <th>ID</th>
            <th>NAME</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
<?php $this->start('script_own')?>
<script>
$(document).ready(function(){
	$("#table_records").dataTable({
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": "<?php echo $this->Html->Url(array('controller' => 'Record', 'action' => 'ajax')); ?>"
	});
})
</script>
<?php $this->end()?>