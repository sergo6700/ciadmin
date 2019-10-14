                <div class="container">
                    <div class="row">
                        <div class="well m-auto btn-primary p-2 rounded">
                            <?php
                            $attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');
                            echo form_open('member/product', $attributes);
                            ?>

                            <label class="sr-only" for="search_string">Search</label>
                                <input type="text" class="form-control my-1 mr-sm-2" id="inlineFormInputName2" value="<?= $search_string_selected?>" name="search_string" placeholder="Search" id="search_String">

                                <label class="sr-only" for="brand">Brand</label>
                                <select name="manufacture_id" class="custom-select my-1 mr-sm-2" id="brand">
                                    <option selected>Select Brand</option>
                                    <?php foreach ($manufactures as $row){?>
                                        <option value="<?= $row['id']?>"><?= $row['name'] ?></option>
                                    <?php } ?>
                                </select>
                                <label class="sr-only" for="model">Model</label>
                                <select name="category_id" class="custom-select my-1 mr-sm-2" id="model">
                                    <option selected>Select Model</option>
                                </select>
                                <label  class="sr-only" for="order">Order</label>
                                <select name="order" class="custom-select my-1 mr-sm-2" id="order">
                                    <?php
                                    $options_products = array();
                                    foreach ($products as $array) {
                                        foreach ($array as $key => $value) { ?>
                                            <option value="<?= $key?>"><?= $key ?></option>
                                        <?php }
                                        break;
                                    }?>
                                </select>
                               <?php
                               $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary  w-sm-100', 'value' => 'Search');
                               $options_order_type = array('Asc' => 'Asc', 'Desc' => 'Desc');
                               echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="custom-select my-1 mr-sm-2"');
                               echo form_submit($data_submit);
                               echo form_close();
                               ?>
                        </div>
                        <?php
                            foreach($products as $row){ ?>
                        <div id="<?= 'body' . $row['id']?>" class="col-12 col-sm-8 col-md-6 col-lg-4 mt-4 shadow-lg p-2">

                            <div class="card position-relative">
                                <img class="card-img" style="width: 100%; height: 200px; object-fit: cover;" width="400" height="300" src="<?= $row['image'] ?>" alt="Vans">
                                <div class="card-body">
                                    <h4 class="card-title"><?= $row['product_name'] ?></h4>
                                    <h6 class="card-subtitle d-inline  mb-2 text-muted">Model: <?= $row['product_category'] ?></h6>
                                    <p class="card-text">
                                        <?= $row['description'] ?>
                                    </p>
                                    <div class="form-group">
                                        <?php $error = $this->session->userdata('error_' . $row['id'])?>
                                        <div id="<?=  'error_' . $row['id'] ?>" class="asa"></div>
                                        <h6 class="card-subtitle d-inline  mb-2 text-muted">Stock: <?= $row['stock'] ?></h6>
                                        <label for="count">Quality</label>
                                        <form class="ajax_form">
                                            <input  type="number" class=" w-100 form-control"  id="count_<?= $row['id']?>" name="count_of_product" value="1">
                                            <input type="hidden" name="product_id" value="<?= $row['id']?>">
                                            <button type="submit" class="btn btn-danger url_link mt-3">
                                                Add to card
                                            </button>
                                        </form>
                                    </div>
                                    <div class="buy d-flex justify-content-between align-items-center">
                                        <div class="price text-success"><h5 class="mt-4">$<?= $row['sell_price'] ?></h5></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                 </div>
                    <div id="container m-auto">
                        <?php echo $this->pagination->create_links(); ?>
                    </div>
