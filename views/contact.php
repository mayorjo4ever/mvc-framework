<?php 
use app\core\Model; 
use app\core\form\inputField;
use app\core\form\TextareaField;
 
  /** @var $this app\core\View;*/  
    /** @var $model app\model\ContactForm;*/ 
    $this->title = 'Contact Us'; 
?>
<?php 
/* @var $model User*/
?>
<div class="row">
    <div class="col-md-8 col-xl-6 pt-5 offset-2">
        <h1 class="mb-4">Contact Us</h1>
        <?php // var_dump($errors);?>
        <?php $form = \app\core\form\Form::begin('','post'); ?>
        <?php echo $form->field($model, 'subject'); ?>
        <?php echo $form->field($model, 'email'); ?>
        <?php echo new TextareaField($model, 'body') ?>
        
        <button type="submit" class="btn btn-primary">Submit</button>
        <?php echo \app\core\form\Form::end();
        ?>         
    </div>  

</div> 
