
<div id="message1">
    <?php
    if (isset($_POST['data']['Type']['type']))
    {
        echo '<strong>You had selected '.$_POST['data']['Type']['type'].'</strong>';
    }
    ?>

<?php echo $this->Form->create('Type',array('id'=>'form_type','type'=>'file','class'=>'','method'=>'POST','autocomplete'=>'off','inputDefaults'=>array(
				
				'label'=>false,'div'=>false,'type'=>'text','required'=>false)))?>
	
<?php echo __("Hi, please choose a type below:")?>
<br><br>

<?php $options_new = array(
 		'Type1' => __('<span  class="dialog" data-id="dialog_1" style="color:blue" data-content="&lt;span style=&quot;display:inline-block&quot;&gt;&lt;ul&gt;&lt;li&gt;Description .......&lt;/li&gt;
 				&lt;li&gt;Description 2&lt;/li&gt;&lt;/ul&gt;&lt;/span&gt;">Type1</span><div id="dialog_1" class="hide dialog" data-content="Type 1">

 				</div>'),
		'Type2' => __('<span  class="dialog" style="color:blue"  data-content="&lt;span style=&quot;display:inline-block&quot;&gt;&lt;ul&gt;&lt;li&gt;Desc 1 .....&lt;/li&gt;
 				&lt;li&gt;Desc 2...&lt;/li&gt;&lt;/ul&gt;&lt;/span&gt;">Type2</span><div id="dialog_2" class="hide dialog" data-content="Type 2">
 				
 				</div>')
		);?>

<?php echo $this->Form->input('type', array('legend'=>false, 'type' => 'radio', 'options'=>$options_new,'before'=>'<label class="radio line notcheck">','after'=>'</label>' ,'separator'=>'</label><label class="radio line notcheck">'));?>
    <?php echo $this->Form->end('Save'); ?>
<?php echo $this->Form->end();?>

</div>

<style>
.showDialog:hover{
	text-decoration: underline;
}

#message1 .radio{
	vertical-align: top;
	font-size: 13px;
}

.control-label{
	font-weight: bold;
}

.wrap {
	white-space: pre-wrap;
}

</style>

<?php $this->start('script_own')?>
<script>

$(document).ready(function(){
	$(".dialog").popover({
        html: true,
        placement: "right"
	});

	
	$(".showDialog").click(function(){ var id = $(this).data('id'); $("#"+id).dialog('open'); });

})
$(document).on('click', '.popover', function () {
    $(".dialog").popover('hide');

});


</script>
<?php $this->end()?>