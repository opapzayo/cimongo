<section class="shop_grid_area section-padding-80">
    <div class="container">
        <?php
        if ($this->session->flashdata('success-msg')) {
        ?>
            <div class="alert alert-success" role="alert">
                Save Product Success
            </div>
        <?php
        }
        ?>
        <form method="get">
            <div class="row">
                <div class="col-2">
                    <a href="<?php echo base_url('products/create') ?>" class="btn btn-success"><i class="fas fa-plus"></i>New Product</a>
                </div>
                <div class="col-5">
                    <div class="form-group">
                        <input type="text" name="name_search" class="form-control" placeholder="Search by name" value="<?php echo $name_search; ?>">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <select class="form-control" name="cate_search" id="exampleFormControlSelect1">
                            <option value="">Select Product Categories</option>
                            <?php 
                            foreach ($categories as $key => $value) { 
                            ?>
                                <option value="<?php echo $value['_id'] ?>" <?php echo ($cate_search == $value['_id']) ? 'selected' : ''; ?>><?php echo $value['cate_name'] ?></option>
                            <?php 
                            } 
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-2">
                    <button type="submit" name="search" class="btn btn-success" value="search"><i class="fas fa-search"></i> Search</button>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Categories</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($products as $key => $value) {
                        ?>
                            <tr>
                                <th scope="row"><?php echo ($key + 1) ?></th>
                                <td><?php echo $value['p_name'] ?></td>
                                <td><?php echo $value['priceEach'] ?></td>
                                <td><?php echo getCategoriesNameFromId($value['cate_id']['$oid']) ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>