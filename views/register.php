<?php 
  /** @var $this app\core\View;*/  
    $this->title = 'Register'; 
?>
<?php 
/* @var $model User*/
?>
<div class="row">
    <div class="col-md-8 col-xl-6 pt-5 offset-2">
        <h1 class="mb-4">Register your account</h1>
        <?php // var_dump($errors);?>
        <?php $form = \app\core\form\Form::begin('','post'); ?>
        <div class="row"> 
            <div class="col"><?php echo $form->field($model, 'firstname'); ?></div>
              <div class="col"><?php echo $form->field($model, 'lastname'); ?></div> 
        </div> 
        <?php echo $form->field($model, 'email'); ?>
        <?php echo $form->field($model, 'password')->passwordField(); ?>
        <?php echo $form->field($model, 'confirm_password')->passwordField(); ?>
        <button type="submit" class="btn btn-primary">Submit</button>
        <?php echo \app\core\form\Form::end();
        ?>         
    </div>  

</div> 
