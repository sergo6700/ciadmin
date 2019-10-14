<div class="container top">

    <ul class="breadcrumb">
        <li>
            <a href="<?php echo site_url("admin"); ?>">
                <?php echo ucfirst($this->uri->segment(1));?>
            </a>
            <span class="divider">/</span>
        </li>
        <li>
            <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>">
                <?php echo ucfirst($this->uri->segment(2));?>
            </a>
            <span class="divider">/</span>
        </li>
        <li class="active">
            <a href="#">New</a>
        </li>
    </ul>

    <div class="page-header">
        <h2>
            Adding <?php echo ucfirst($this->uri->segment(2));?>
        </h2>
    </div>

    <?php
    //flash messages
    if(isset($flash_message)){
        if($flash_message == TRUE)
        {
            echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> new category created with success.';
            echo '</div>';
        }else{
            echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
            echo '</div>';
        }
    }
    ?>

    <?php
    //form data
    $attributes = array('class' => 'form-horizontal ajax_form', 'id' => '');

    //form validation
    echo validation_errors();

    echo form_open('admin/categories/add', $attributes);
    ?>
    <div class="form-row align-items-center">
        <div class="control-group w-100">
            <label for="inputError" class="control-label">Name</label>
            <div class="controls">
                <input type="text" class="w-25 form-control"  id="" name="name" value="<?php echo set_value('name'); ?>" >
                <!--<span class="help-inline">Woohoo!</span>-->
            </div>
        </div>
        <div class="control-group w-100">
            <select class="custom-select w-25  mr-sm-2" name="manufactore" id="inlineFormCustomSelect">
                <option selected>Choose...</option>
                <?php foreach ($manufacturers as $row){?>
                <option value="<?= $row['id']?>"><?= $row['name']?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-actions">
            <button class="btn btn-primary" type="submit">Save changes</button>
            <button class="btn" type="reset">Cancel</button>
        </div>
    </div>

    <?php echo form_close(); ?>

</div>
