<div class="container top">
    <div class="row">
        <div class="span12 columns">
            <div class="well">
                <table class="table table-striped table-bordered table-condensed">
                    <thead>
<!--          ete kategoyan nshvaca bmw tox select ani bolor bmw categoryayov productner@ ev selecti mej nshi productsi meji product_categoryan           -->
                    <tr>
                        <th class="header">#</th>
                        <th class="red header">Name</th>
                        <th class="red header">Model</th>
                        <th class="yellow header headerSortDown">Description</th>
                        <th class="green header">Stock</th>
                        <th class="red header">Sell Price</th>
                        <th class="red header">Count</th>
                        <th class="red header">Buy</th>
                        <th class="red header">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($list_products as $row) {?>
                         <tr>
                         <td class="id"><?= $row['id']?></td>
                         <td><?= $row['product_name']?></td>
                         <td><?= $row['product_category']?></td>
                         <td><?= $row['description']?></td>
                         <td><?= $row['stock']?></td>
                         <td><?= $row['sell_price']?></td>
                         <td><?= $row['count']?></td>
                         <td class="crud-actions">
                            <a href="<?= site_url("member").'/products/buyed/'.$row["product_id"].'/'.$row['count']?>" class="btn btn-info" id="buy">BUY</a>
                         </td>
                         <td class="crud-actions">
                            <a href="<?= site_url("member").'/products/del/'.$row["product_id"]?>" class="btn btn-info" id="buy">DELETE</a>
                         </td>
                       </tr>
                    <?php } //end foreach?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
