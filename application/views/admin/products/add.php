
<div class="container">
    <div class="page-header">
        <h2>
            Adding <?php echo ucfirst($this->uri->segment(2));?>
        </h2>
    </div>
    <div class="justify-content-center align-items-center">
        <?php
        //flash messages
        if(isset($flash_message)){
            if($flash_message == TRUE)
            {
                echo '<div class="alert alert-success">';
                echo '<a class="close" data-dismiss="alert">×</a>';
                echo '<strong>Well done!</strong> new product created with success.';
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
        $attributes = array('class' => 'd-inline ajax_form');
        $options_manufacture = array('' => "Select");
        foreach ($manufactures as $row)
        {
            $options_manufacture[$row['id']] = $row['name'];
        }
        $options_category = array('' => "Select");
        foreach ($categories as $row)
        {
            $options_category[$row['id']] = $row['name'];
        }

        //form validation
        echo validation_errors();

        echo form_open_multipart('admin/products/add', $attributes);
        ?>
        <div class="form-group">
            <div class="controls">
                <input type="text" id="" name="name" placeholder="Name" value="<?php echo set_value('name'); ?>" >
                <!--<span class="help-inline">Woohoo!</span>-->
            </div>
        </div>
        <div class="form-group">
            <div class="controls">
                <input type="text" id="" name="model" placeholder="Model" value="<?php echo set_value('product_category'); ?>" >
                <!--<span class="help-inline">Woohoo!</span>-->
            </div>
        </div>
        <?php echo form_upload('file', 'save', 'class = "myInputs"')?>

        <div class="form-group">
            <div class="controls">
                <input type="text" id="" name="description" placeholder="Description" value="<?php echo set_value('description'); ?>" >
                <!--<span class="help-inline">Woohoo!</span>-->
            </div>
        </div>
        <div class="form-group">
            <div class="controls">
                <input type="text" id="" name="stock" placeholder="Stock" value="<?php echo set_value('stock'); ?>">
                <!--<span class="help-inline">Cost Price</span>-->
            </div>
        </div>
        <div class="form-group">
            <div class="controls">
                <input type="text" name="sell_price" placeholder="Sell price" value="<?php echo set_value('sell_price'); ?>">
                <!--<span class="help-inline">OOps</span>-->
            </div>
        </div>
        <div class="form-group">
            <label for="manufacture_id" class="control-label">Manufacture</label>
                <div class="controls">
                    <select name="brand" id="brand">
                        <option value="null" selected>Select Brand</option>
                        <?php foreach ($manufactures as $row){?>
                            <option value="<?= $row['id']?>"><?= $row['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        <div class="form-group">
            <label for="manufacture_id" class="control-label">Select Model</label>
                <div class="controls">
                    <select name="submodel" id="model">
                        <option value="null" selected>Select Model</option>
                    </select>
                </div>
            </div>
        </div>


        <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
    </div>

</div>
