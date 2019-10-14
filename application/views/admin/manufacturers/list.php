    <div class="container top">

      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("admin"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a>
          <span class="divider">/</span>
        </li>
        <li class="active">
          <?php echo ucfirst($this->uri->segment(2));?>
        </li>
      </ul>

      <div class="page-header users-header">
        <h2>
          <?php echo ucfirst($this->uri->segment(2));?>
          <a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add" class="btn btn-success">Add a new</a>
        </h2>
      </div>

      <div class="row">
        <div class="span12 columns">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="header">#</th>
                            <th class="yellow header headerSortDown">Name</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($manufacturers as $row)
                        {
                            echo '<tr>';
                            echo '<td>'.$row['id'].'</td>';
                            echo '<td>'.$row['name'].'</td>';
                            echo '<td class="crud-actions">
                              <a href="'.site_url("admin").'/manufacturers/update/'.$row['id'].'" class="btn btn-info">view & edit</a>  
                              <a href="'.site_url("admin").'/manufacturers/delete/'.$row['id'].'" class="btn btn-danger">delete</a>
                            </td>';
                            echo '</tr>';
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>

          <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>

      </div>
    </div>