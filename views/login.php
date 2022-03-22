<?php 
  /** @var $this app\core\View;*/  
    $this->title = 'Login'; 
?><?php 
/** @var $model \app\models\User */
?> 
<div class="row">
    <div class="col-md-8 col-xl-6 pt-5 offset-2">
        <h1 class="mb-4">Login</h1>  <?php // password_hash("12345678",PASSWORD_DEFAULT); ?>
        <?php $form = \app\core\form\Form::begin('','post'); ?>       
        <?php echo $form->field($model, 'email'); ?>
        <?php echo $form->field($model, 'password')->passwordField(); ?>
        <button type="submit" class="btn btn-primary">Submit</button>
        <?php echo \app\core\form\Form::end(); ?>    
            
    </div>  

</div> 
