<?php
$cookie = $this->input->cookie('info', TRUE);

    $data = json_decode($cookie);

?>
<div class="container top">
    <div class="row">
        <div class="span12 columns">
            <div class="well">
                <table class="table table-striped table-bordered table-condensed">
                    <thead>
                    <tr>
                        <th class="header">#</th>
                        <th class="red header">Name</th>
                        <th class="red header">Model</th>
                        <th class="yellow header headerSortDown">Description</th>
                        <th class="green header">Stock</th>
                        <th class="red header">Sell Price</th>
                        <th class="red header">Count</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($data as $row)
                    {
//                   echo "<pre>"; var_dump($row);die;?>
                        <tr>
                            <td class="id"><?= $row->id ?></td>
                            <td><?= $row->product_name ?></td>
                            <td><?= $row->product_category ?></td>
                            <td><?= $row->description ?></td>
                            <td><?= $row->stock ?></td>
                            <td><?= $row->sell_price ?></td>
                            <td><?= $row->count ?></td>
                        </tr>
                    <?php } //end foreach?>
                    </tbody>
                </table>

                <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>';?>

            </div>
        </div>
